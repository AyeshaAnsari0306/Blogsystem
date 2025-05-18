<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles first
        $this->call([
            RoleSeeder::class,
        ]);

        // Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ])->assignRole('Admin');

        // Author user
        User::factory()->create([
            'name' => 'Author User',
            'email' => 'author@example.com',
        ])->assignRole('Author');

        // Regular user
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
        ])->assignRole('User');

        // Additional test users
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('User');
        });
        $this->call([
            CategorySeeder::class,
        ]);
    }
}