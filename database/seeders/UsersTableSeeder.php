<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsertableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usersinfo')->insert([
            [
                'id' => Str::uuid(),
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'sex' => 'Male',
                'birthday' => '1979-01-01',
                'username' => 'admin123',
                'email' => 'admin@itelec3.test',
                'password' => Hash::make('adminpassword'),
                'agreed_to_terms' => true,
                'user_type' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'first_name' => 'Sheena',
                'last_name' => 'Doe',
                'sex' => 'Female',
                'birthday' => '1996-04-27',
                'username' => 'sheena123',
                'email' => 'sheena_doe@itelec3.test',
                'password' => Hash::make('sheenapassword'),
                'agreed_to_terms' => true,
                'user_type' => 'Customer',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
