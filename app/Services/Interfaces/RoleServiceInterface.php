<?php

namespace App\Services\Interfaces;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

interface RoleServiceInterface
{
    public function store(Request $request): RedirectResponse;

    public function update(Request $request, Role $role): RedirectResponse;

    public function destroy(Role $role): RedirectResponse;

    public function guardEditable(Role $role, string $action = 'editar'): ?RedirectResponse;
}
