<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Dummy login credentials
        $correctUsername = 'admin';
        $correctPassword = 'password123';

        if ($username === $correctUsername && $password === $correctPassword) {
            session(['logged_in' => true]);
            return redirect('/dashboard');
        } else {
            return back()->withErrors(['Invalid credentials.']);
        }
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->except('password');
        return view('registration-data', compact('data'));
    }
}
