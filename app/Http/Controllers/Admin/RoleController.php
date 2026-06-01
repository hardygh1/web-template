<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\RoleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Admin\Permission;
use Spatie\Permission\Models\Permission as SpatiePermission;

class RoleController extends Controller
{
    public function __construct(private readonly RoleServiceInterface $roles)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read_role');

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create_role');

        $permissions = \Spatie\Permission\Models\Permission::all()
        ->groupBy(function ($permission) {
            return explode('_', $permission->name)[1] ?? 'general';
        });
    
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create_role');
        return $this->roles->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        Gate::authorize('read_role');
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        Gate::authorize('update_role');
        if ($redirect = $this->roles->guardEditable($role)) {
            return $redirect;
        }

        $permissions = SpatiePermission::all()
            ->groupBy(function ($permission) {
                return explode('_', $permission->name)[1] ?? 'general';
            });

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('update_role');
        return $this->roles->update($request, $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Gate::authorize('delete_role');
        return $this->roles->destroy($role);
    }
}
