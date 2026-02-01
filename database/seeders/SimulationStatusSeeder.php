<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SimulationStatus;

class SimulationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SimulationStatus::create([
            'name' => 'Simulado',
            'color' => '#FFCDD2',
        ]);

        SimulationStatus::create([
            'name' => 'Em Análise',
            'color' => '#C8E6C9',
        ]);

        SimulationStatus::create([
            'name' => 'Banco Analisando',
            'color' => '#FFCDD2',
        ]);

        SimulationStatus::create([
            'name' => 'Aprovado',
            'color' => '#C8E6C9',
        ]);

        SimulationStatus::create([
            'name' => 'Reprovado',
            'color' => '#FFCDD2',
        ]);
    }
}
