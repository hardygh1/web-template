<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'brunoguizado@gmail.com'],
            [
                'name' => 'Victor Arana',
                'password' => bcrypt('12345678'),
                'dni' => '12345679',
                'phone' => '987654321',
                'address' => 'Calle Falsa 123',
            ]
        );

        $user->assignRole('Administrador');
    }
}
