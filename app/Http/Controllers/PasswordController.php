<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    // Show the password change form
    public function edit()
    {
        return view('password.change');
    }

    // Handle the password change request
    public function update(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the old password matches
        if (!Hash::check($validated['old_password'], Auth::user()->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }

        // Update the password
        Auth::user()->update([
            'password' => bcrypt($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}
