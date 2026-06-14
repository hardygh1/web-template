<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrador Global
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $admin->givePermissionTo(Permission::all());

        // Company Admin - Administrador de Empresa
        $companyAdmin = Role::firstOrCreate(['name' => 'Company Admin']);
        $companyAdmin->givePermissionTo([
            'access_dashboard',
            'view_company',
            'edit_company',
            'create_user',
            'read_user',
            'update_user',
            'delete_user',
        ]);

        // Manager - Gerente de Empresa
        $manager = Role::firstOrCreate(['name' => 'Gerente']);
        $manager->givePermissionTo([
            'access_dashboard',
            'view_company',
            'read_user',
        ]);

        // Usuario Base
        $user = Role::firstOrCreate(['name' => 'Usuario']);
        $user->givePermissionTo([
            'access_dashboard',
            'view_company',
            'read_user',
        ]);
    }
}
