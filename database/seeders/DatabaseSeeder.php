<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Default Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        // Create 5 Admin users, each with 2 patients
        User::factory()
            ->count(5) // 5 Admin
            ->state(['role' => 'admin']) // Set role as 'admin'
            ->hasPatients(2) // Each Admin has 2 Patients
            ->create();
    }
}
