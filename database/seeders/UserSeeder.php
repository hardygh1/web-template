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
        $user = User::factory()->create([
            'name' => 'Victor Arana',
            'email' => 'brunoguizado@gmail.com',
            'password' => bcrypt('12345678'),
            'dni' => '12345679',
            'phone' => '987654321',
            'address' => 'Calle Falsa 123',
        ]);

        $user->assignRole('Admin');

        $user->doctor()->create();
    }
}
