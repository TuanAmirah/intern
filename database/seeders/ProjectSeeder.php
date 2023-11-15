<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            "project_name" => "BGSP"
        ]);

        Project::create([
            "project_name" => "SPAN"
        ]);
        
        Project::create([
            "project_name" => "MUO"
        ]);
    }
}
