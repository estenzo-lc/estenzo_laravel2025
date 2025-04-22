<?php

<<<<<<< HEAD
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
=======
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // Admin User
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@itelec3.test',
                'username' => 'admin123',
                'password' => Hash::make('password123'), // Use Hash facade for security
                'user_type' => 'Admin',
                'sex' => 'Male',
                'birthday' => '1979-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sheena User
            [
                'first_name' => 'Sheena',
                'last_name' => 'Doe',
                'email' => 'sheena_doe@itelec3.test',
                'username' => 'sheena123',
                'password' => Hash::make('password123'), // Use Hash facade for security
                'user_type' => 'Customer',
                'sex' => 'Female',
                'birthday' => '1996-04-27',
                'created_at' => now(),
                'updated_at' => now(),
            ],
>>>>>>> 2ef51e9fe0291416c8b1dbb50e1385acf6720a69
        ]);
    }
}
