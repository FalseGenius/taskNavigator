<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'full_name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Create 20 random users
        User::factory()->count(20)->create();
    }
}
