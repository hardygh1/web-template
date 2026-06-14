<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'access_dashboard',

            // Company Permissions
            'view_company',
            'create_company',
            'edit_company',
            'delete_company',

            // Role Permissions
            'create_role',
            'read_role',
            'update_role',
            'delete_role',

            // User Permissions
            'create_user',
            'read_user',
            'update_user',
            'delete_user',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }
    }
}
