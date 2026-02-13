<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Venda Truck Admin',
            'email' => 'admin@vendatruck.com.br',
            'password' => 'Rm@150917',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Julian Cezar',
            'email' => 'julian.fontana@hotmail.com',
            'password' => 'juHH@006412',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Lojista',
            'email' => 'lojista@pontodocamonhao.com.br',
            'password' => 'Rm@150917',
            'role' => 'lojista',
            'company_id' => 1,
        ]);

        User::create([
            'name' => 'Lojista 2',
            'email' => 'lojista2@truckcenter.com.br',
            'password' => 'Rm@150917',
            'role' => 'lojista',
            'company_id' => 2,
        ]);
    }
}
