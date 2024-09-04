<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create three users
         User::create([
            'name' => 'User1',
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'User2',
            'username' => 'user2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'User3',
            'username' => 'user3',
            'email' => 'user3@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
