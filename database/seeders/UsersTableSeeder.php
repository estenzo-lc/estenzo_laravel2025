<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create Admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'sex' => 'Male',
            'birthday' => '1979-01-01',
            'username' => 'admin',
            'email' => 'admin@itelec3.test',
            'password' => Hash::make('adminpass'),
            'user_type' => 'Admin',
            'name' => 'Admin Admin',  // Add the name field here
        ]);

        // Create Customer user
        User::create([
            'first_name' => 'Sheena',
            'last_name' => 'Doe',
            'sex' => 'Female',
            'birthday' => '1996-04-27',
            'username' => 'sheena_doe',
            'email' => 'sheena_doe@itelec3.test',
            'password' => Hash::make('sheenapass'),
            'user_type' => 'Customer',
            'name' => 'Sheena Doe', // Add the name field here
        ]);
    }
}
