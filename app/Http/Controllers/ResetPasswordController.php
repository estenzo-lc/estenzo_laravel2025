<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;
use App\Notifications\ResetForgottenPasswordNotification;

class ResetPasswordController extends Controller
{
    /**
     * Show the password reset form with the provided token.
     *
     * @param string $token The password reset token from the email
     * @return \Illuminate\View\View
     */
    public function showResetForm($token)
    {
        // Display the reset password form and pass the token to the view
        return view('reset-password', ['token' => $token]);
    }

    /**
     * Handle the password reset logic.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email|exists:usersinfo,email',
            'password' => 'required|min:8|confirmed', // password_confirmation must match
            'token' => 'required'
        ]);

        // Check if the token and email combination exists in password_resets table
        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        // If not found, token is invalid or expired
        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid or expired reset token.']);
        }

        // Retrieve the user and update the password
        $user = Usersinfo::where('email', $request->email)->first();
        $user->password = Hash::make($request->password); // Securely hash the new password
        $user->save();

        // Send a notification to inform the user that their password was changed
        $user->notify(new ResetForgottenPasswordNotification());

        // Delete the used password reset token
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Redirect the user to the login page with a success message
        return redirect()->route('login')->with('success', 'Your password has been reset successfully!');
    }
}
