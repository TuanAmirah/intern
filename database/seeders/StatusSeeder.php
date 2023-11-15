<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            "status_name" => "New Analysis",
            
        ]);
        Status::create([
            "status_name" => "In-Progress",
        ]);

        Status::create([
            "status_name" => "Completed",
        ]);

        Status::create([
            "status_name" => "Rejected",
        ]);
    }
}
