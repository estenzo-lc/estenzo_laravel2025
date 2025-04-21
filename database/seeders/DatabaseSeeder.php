<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'username' => 'testuser',
            'sex' => 'Male',
            'birthday' => '2000-01-01',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'Customer',
        ]);
    }
}
