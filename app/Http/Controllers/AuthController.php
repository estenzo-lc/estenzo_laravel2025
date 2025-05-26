<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;

class AuthController extends Controller
{
    // Handles user authentication logic

    /**
     * Show the login form view.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle login request.
     * Validates user credentials and checks if email is verified.
     */
    public function login(LoginRequest $request)
    {
        // Attempt to retrieve the user by username
        $user = Usersinfo::where('username', $request->username)->first();
    
        // Check if user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            
            // Check if the user's email has been verified
            if (is_null($user->email_verified_at)) {
                return back()->withErrors([
                    'email' => 'Please verify your email before logging in.',
                ])->withInput(); // Keep the old input except the password
            }
    
            // Store user information in session
            session(['user' => $user]);

            // Redirect to dashboard after successful login
            return redirect()->route('dashboard');
        }
    
        // If login fails, return back with error
        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    /**
     * Verify user email using the token.
     */
    public function verifyEmail($token)
    {
        // Find user by verification token or fail with 404
        $user = Usersinfo::where('verification_token', $token)->firstOrFail();
    
        // Mark email as verified and remove the token
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();
    
        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
    }
}
