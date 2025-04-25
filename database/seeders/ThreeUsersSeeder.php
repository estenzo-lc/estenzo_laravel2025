<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ThreeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => Str::uuid(),
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'sex' => 'Female',
                'birthday' => '1992-05-14',
                'username' => 'alicejohnson',
                'email' => 'alice.johnson@itelec3.test',
                'password' => Hash::make('password123'),
                'agreed_to_terms' => true,
                'user_type' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'first_name' => 'Ethan',
                'last_name' => 'Williams',
                'sex' => 'Male',
                'birthday' => '1989-09-22',
                'username' => 'ethanwilliams',
                'email' => 'ethan.williams@itelec3.test',
                'password' => Hash::make('password123'),
                'agreed_to_terms' => true,
                'user_type' => 'Customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'first_name' => 'Sophia',
                'last_name' => 'Davis',
                'sex' => 'Female',
                'birthday' => '1995-01-30',
                'username' => 'sophiadavis',
                'email' => 'sophia.davis@itelec3.test',
                'password' => Hash::make('password123'),
                'agreed_to_terms' => true,
                'user_type' => 'Customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('usersinfo')->insert($users);
    }
}