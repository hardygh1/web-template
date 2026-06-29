<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
        private readonly RoleRepositoryInterface $roles
    ) {
    }

    public function getCreateData(): array
    {
        return [
            'roles' => $this->roles->all(),
        ];
    }

    public function getEditData(User $user): array
    {
        return [
            'user' => $user,
            'roles' => $this->roles->all(),
        ];
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'dni' => 'required|string|max:8|unique:users',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $roleId = (int) $data['role_id'];
        unset($data['role_id']);

        $authUser = Auth::user();
        $data['company_id'] = $authUser->company_id;

        $user = $this->users->create($data);
        $this->users->attachRole($user, $roleId);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario creado correctamente',
            'text' => 'El usuario ha sido creado exitosamente.',
        ]);

        return redirect()->route('admin.users.index');
    }

    public function guardCompany(User $user): ?RedirectResponse
    {

        $authUser = Auth::user();

        if ($authUser->company_id === $user->company_id) {
            return null;
        }

        session()->flash('swal', [
            'icon' => 'error',
            'title' => 'Acceso denegado',
            'text' => 'No puedes realizar esta acción sobre un usuario de otra empresa.',
        ]);

        return redirect()->route('admin.users.index');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if ($redirect = $this->guardCompany($user)) {
            return $redirect;
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'dni' => 'required|string|max:8|unique:users,dni,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $roleId = (int) $data['role_id'];
        unset($data['role_id']);

        $this->users->update($user, $data);

        if ($request->filled('password')) {
            $this->users->updatePassword($user, $request->password);
        }

        $this->users->syncRole($user, $roleId);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario actualizado',
            'text' => 'El usuario ha sido actualizado exitosamente.',
        ]);

        return redirect()->route('admin.users.edit', $user);
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($redirect = $this->guardCompany($user)) {
            return $redirect;
        }

        $this->users->detachRoles($user);
        $this->users->delete($user);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario eliminado',
            'text' => 'El usuario ha sido eliminado exitosamente.',
        ]);

        return redirect()->route('admin.users.index');
    }
}
