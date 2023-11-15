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
        User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => "12345678",
        ]);

        User::create([
            "name" => "Tuan Amirah",
            "email" => "amirah@gmail.com",
            "password" => "12345678",
        ]);

        User::create([
            "name" => "Nur Aliya Alisa",
            "email" => "alisa@gmail.com",
            "password" => "12345678",
        ]);

    }
}
