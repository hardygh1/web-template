<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    /**
     * Determine whether the user can view any companies.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_company');
    }

    /**
     * Determine whether the user can view the company.
     */
    public function view(User $user, Company $company): bool
    {
        return $user->hasPermissionTo('view_company') &&
               ($user->id === $company->created_by || $user->hasRole('Administrador'));
    }

    /**
     * Determine whether the user can create companies.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_company');
    }

    /**
     * Determine whether the user can update the company.
     */
    public function update(User $user, Company $company): bool
    {
        return $user->hasPermissionTo('edit_company') &&
               ($user->id === $company->created_by || $user->hasRole('Administrador'));
    }

    /**
     * Determine whether the user can delete the company.
     */
    public function delete(User $user, Company $company): bool
    {
        return $user->hasPermissionTo('delete_company') &&
               $user->hasRole('Administrador');
    }

    /**
     * Determine whether the user can restore the company.
     */
    public function restore(User $user, Company $company): bool
    {
        return $user->hasRole('Administrador');
    }

    /**
     * Determine whether the user can permanently delete the company.
     */
    public function forceDelete(User $user, Company $company): bool
    {
        return $user->hasRole('Administrador');
    }
}
