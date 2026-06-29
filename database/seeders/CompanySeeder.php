<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['name' => 'Empresa Alpha', 'email' => 'contacto@empresaalpha.com'],
            ['name' => 'Empresa Beta',  'email' => 'contacto@empresabeta.com'],
            ['name' => 'Empresa Gamma', 'email' => 'contacto@empresagamma.com'],
        ];

        foreach ($companies as $index => $data) {
            $company = Company::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'       => $data['name'],
                    'slug'       => Str::slug($data['name']),
                    'legal_name' => $data['name'] . ' S.A.C.',
                    'phone'      => '01' . str_pad($index + 1, 7, '0', STR_PAD_LEFT),
                    'status'     => 'active',
                ]
            );

            $slug = Str::slug($data['name'], '');

            for ($i = 1; $i <= 10; $i++) {
                $user = User::firstOrCreate(
                    ['email' => "user.{$slug}.{$i}@test.com"],
                    [
                        'name'       => "User({$data['name']}) - {$i}",
                        'password'   => bcrypt('12345678'),
                        'dni'        => str_pad(($index * 10 + $i), 8, '0', STR_PAD_LEFT),
                        'phone'      => '9' . str_pad(($index * 100 + $i), 8, '0', STR_PAD_LEFT),
                        'address'    => "Dirección de prueba {$i}",
                        'company_id' => $company->id,
                    ]
                );

                $user->syncRoles($i === 1 ? 'Company Admin' : 'Usuario');
            }
        }
    }
}
