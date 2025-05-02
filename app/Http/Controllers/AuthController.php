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

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session(['user' => $user->id]);
                return redirect()->route('dashboard');
            } else {
                return back()->withErrors(['password' => 'Incorrect password.'])->withInput();
            }
        }

        return back()->withErrors(['username' => 'Username not found.'])->withInput();
    }

    public function logout(Request $request)
{
    $request->session()->forget('user');              // Remove the user session
    $request->session()->invalidate();                // Invalidate the session
    $request->session()->regenerateToken();           // Regenerate CSRF token for security

    return redirect()->route('login')->with('status', 'You have been logged out.');
}

}