<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterUserRequest $request)
    {
        // Create the new user
        $user = new User;
        $user->id = Str::uuid();
        $user->first_name = $request->first_name; // Ensure this matches your request
        $user->last_name = $request->last_name;   // Ensure this matches your request
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Log the user in
        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Registered successfully');
    }
}