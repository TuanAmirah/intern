<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Phase::create([
            "phase_name" => "Requirement Analysis"
        ]);

        Phase::create([
            "phase_name" => "System Design"
        ]);

        Phase::create([
            "phase_name" => "Implementation"
        ]);

        Phase::create([
            "phase_name" => "Testing"
        ]);

        Phase::create([
            "phase_name" => "Deployment"
        ]);

        Phase::create([
            "phase_name" => "Maintanance"
        ]);
    }
}
