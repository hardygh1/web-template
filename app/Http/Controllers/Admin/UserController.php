<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct(private readonly UserServiceInterface $users)
    {
    }

    public function index()
    {
        Gate::authorize('read_user');
        return view('admin.users.index');
    }

    public function create()
    {
        Gate::authorize('create_user');
        return view('admin.users.create', $this->users->getCreateData());
    }

    public function store(Request $request)
    {
        Gate::authorize('create_user');
        return $this->users->store($request);
    }

    public function show(User $user)
    {
        Gate::authorize('read_user');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        Gate::authorize('update_user');
        return view('admin.users.edit', $this->users->getEditData($user));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('update_user');
        return $this->users->update($request, $user);
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete_user');
        return $this->users->destroy($user);
    }
}
