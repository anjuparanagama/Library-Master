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
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
            'password' => bcrypt('admin123'),
            'phone' => '+92-300-1234567',
            'address' => 'Library Main Office, City Center',
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@library.com',
            'password' => bcrypt('user123'),
            'phone' => '+92-321-7654321',
            'address' => '123 Main Street, Apartment 4B',
            'role' => 'user',
        ]);

        // Create a few more users for testing
        User::factory(5)->create([
            'role' => 'user',
        ]);
    }
}
