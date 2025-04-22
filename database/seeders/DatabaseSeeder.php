<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use App\Models\User; // Make sure this is included
=======
use Illuminate\Support\Facades\Hash;
use App\Models\User;
>>>>>>> 2ef51e9fe0291416c8b1dbb50e1385acf6720a69

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
<<<<<<< HEAD
    public function run()
    {
        $this->call(UsersTableSeeder::class);
=======
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
>>>>>>> 2ef51e9fe0291416c8b1dbb50e1385acf6720a69
    }
}
