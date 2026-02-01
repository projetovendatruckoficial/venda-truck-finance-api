<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SimulationType;

class SimulationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SimulationType::create([
            'name' => 'Financiamento',
        ]);

        SimulationType::create([
            'name' => 'Refinanciamento',
        ]);
    }
}
