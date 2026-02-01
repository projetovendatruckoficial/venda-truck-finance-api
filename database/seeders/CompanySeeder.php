<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Ponto do Caminhão',
            'email' => 'contato@pontodocamonhao.com.br',
            'document' => '12345678901234',
            'phone' => '1234567890',
            'address' => 'Rua 1, 123',
            'city' => 'São Paulo',
            'state' => 'SP',
            'zip' => '12345678',
            'country' => 'Brasil',
        ]);

        Company::create([
            'name' => 'Truck Center',
            'email' => 'contato@truckcenter.com.br',
            'document' => '12345678901237',
            'phone' => '1234567890',
            'address' => 'Rua 1, 123',
            'city' => 'São Paulo',
            'state' => 'SP',
            'zip' => '12345678',
            'country' => 'Brasil',
        ]);
    }
}
