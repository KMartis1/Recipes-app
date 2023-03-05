<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create([
            'password' => '$2y$10$pPyQ0YYrKgTSWj0rVcAwiOG5NbbZeEsjNzt8tNCEpjOUKk4Ig4YXG', // "Password"
            'role' => null
        ])->each(function ($user) {
            // Randomly assign either "admin" or null to the role column
            $user->update([
                'role' => rand(0, 1) == 1 ? "Admin" : null
            ]);
        });
    }
}
