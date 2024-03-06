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
            [
                'id' => 3,
                'email' => 'rama@gmail.com',
                'username' => 'rama',
                'password' => bcrypt('password'),
                'firstname' => 'Ramandhika',
                'lastname' => 'Pratama',
            ],
        ];

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'password' => bcrypt('password'),
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
            ];
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
