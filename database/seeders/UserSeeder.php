<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name'=> 'Ali Hamza',
                'email' => 'ah@gmail.com',
                'Password' => bcrypt('112233445566'),
                'role' => 'therapist',
            ],
            [
                'name'=> 'front desk',
                'email' => 'fd@gmail.com',
                'Password' => bcrypt('112233445566'),
                'role' => 'frontdesk'
            ]

            ];

            User::insert($users);
    }
}
