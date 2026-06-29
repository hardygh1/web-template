<?php

namespace App\Services;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Services\Interfaces\RoleServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleService implements RoleServiceInterface
{
    public function __construct(private readonly RoleRepositoryInterface $roles)
    {
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'string'
        ]);

        // 1. Crear rol
        $role = $this->roles->create([
            'name' => $data['name'],
        ]);

        // 2. Limpiar cache Spatie (EVITA 500 ocultos)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 3. Asignar permisos seguros
        $role->syncPermissions($data['permissions'] ?? []);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol creado correctamente',
            'text' => 'El rol ha sido creado exitosamente.',
        ]);

        return redirect()->route('admin.roles.index');
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        if ($redirect = $this->guardEditable($role)) {
            return $redirect;
        }

        $data = $request->validate([
        'name' => 'required|unique:roles,name,' . $role->id,
        'permissions' => 'array',
        'permissions.*' => 'string'
        ]);

        $this->roles->update($role, [
        'name' => $data['name'],
        ]);

        $role->syncPermissions($data['permissions'] ?? []);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol actualizado correctamente',
            'text' => 'El rol ha sido actualizado exitosamente.',
        ]);

        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($redirect = $this->guardEditable($role, 'eliminar')) {
            return $redirect;
        }

        $this->roles->delete($role);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol eliminado correctamente',
            'text' => 'El rol ha sido eliminado exitosamente.',
        ]);

        return redirect()->route('admin.roles.index');
    }

    public function guardEditable(Role $role, string $action = 'editar'): ?RedirectResponse
    {
        if ($role->id > 1) {
            return null;
        }

        session()->flash('swal', [
            'icon' => 'error',
            'title' => 'Error',
            'text' => "No puedes {$action} este rol.",
        ]);

        return redirect()->route('admin.roles.index');
    }
}
