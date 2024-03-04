<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'email' => 'admin@gmail.com',
                'username' => 'Admin',
                'password' => bcrypt('password'),
                'firstname' => 'Ramandhika Ilham',
                'lastname' => 'Pratama',
            ],
            [
                'id' => 2,
                'email' => 'user@gmail.com',
                'username' => 'User',
                'password' => bcrypt('password'),
                'firstname' => 'Jane Smith',
                'lastname' => 'Doe',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}