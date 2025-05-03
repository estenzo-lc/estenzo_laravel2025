<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Usersinfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function save(RegisterUserRequest $request)
    {
        // Validate if password and password_confirmation match
        $validatedData = $request->validated(); // Ensure that the data is already validated by RegisterUserRequest

        if ($validatedData['password'] !== $validatedData['password_confirmation']) {
            return back()->withErrors(['password' => 'Passwords do not match.'])->withInput();
        }

        // Create a new user record
        $user = new Usersinfo;
        $user->id = Str::uuid();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->sex = $request->sex;
        $user->birthday = $request->birthday;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('login')->with('success', 'Registered successfully');
    }
}
