<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default administrator account so the system is usable
        // immediately after seeding. Change the credentials after first login.
        User::firstOrCreate(
            ['username' => 'admin'],
            ['password' => Hash::make('Bagabag2026!')]
        );
    }
}
