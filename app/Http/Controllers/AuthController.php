<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;
class AuthController extends Controller
{
    //



    public function login(LoginRequest $request)
    {
        $user = Usersinfo::where('username', $request->username)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            if (is_null($user->email_verified_at)) {
                return back()->withErrors([
                    'email' => 'Please verify your email before logging in.',
                ])->withInput();
            }
    
            session(['user' => $user]);
            return redirect()->route('dashboard');
        }
    
        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }
    

    public function showLoginForm()
    {
        return view('login');
    }



    public function verifyEmail($token)
    {
        $user = Usersinfo::where('verification_token', $token)->firstOrFail();
    
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();
    
        return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
    }

}
