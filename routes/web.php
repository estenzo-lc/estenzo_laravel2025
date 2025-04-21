<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Login Routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $username = 'testuser';
    $password = 'secret123';

    if ($request->username === $username && $request->password === $password) {
        return redirect()->route('dashboard');
    }

    return redirect()->back()->withErrors(['Invalid credentials.']);
})->name('login.post');

// Registration Routes
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (\Illuminate\Http\Request $request) {
    // Validate the form data
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'sex' => 'required|in:Male,Female',
        'birthday' => 'required|date',
        'password' => 'required|confirmed|min:8', // password confirmation rule
        'username' => 'required|string|max:255|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'agree' => 'accepted'
    ]);

    // Create the new user (for now we won't actually save to DB, just show in the result view)
    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'sex' => $request->sex,
        'birthday' => $request->birthday,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'username' => $request->username
    ]);

    // Optionally, log the user in immediately after registration (if you want)
    auth()->login($user);

    // Redirect to a registration result page or dashboard
    return view('registration_result', [
        'user' => $user,
        'message' => 'Registration successful!'
    ]);
})->name('register.post');
