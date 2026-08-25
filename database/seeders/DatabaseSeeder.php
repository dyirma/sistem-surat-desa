<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create Master Admin Account
        User::updateOrCreate(
            ['email' => 'jangglengannguter@gmail.com'],
            [
                'name' => 'Admin Desa Jangglengan',
                'password' => bcrypt('@Sur4jadm1n19'),
            ]
        );
    }
}
