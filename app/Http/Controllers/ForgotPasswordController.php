<?php

namespace App\Http\Controllers;

use App\Models\Usersinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    /**
     * Show the password reset request form.
     */
    public function showRequestForm()
    {
        return view('forgot-password');
    }

    /**
     * Handle the password reset link request.
     * Validates the email, generates a reset token, stores it, and sends a notification.
     */
    public function sendResetLink(Request $request)
    {
        // Validate that the email is required, properly formatted, and exists in the usersinfo table
        $request->validate([
            'email' => 'required|email|exists:usersinfo,email',
        ]);

        // Generate a secure random token for password reset
        $token = Str::random(64);

        // Store or update the token in the password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Retrieve the user and send the reset password notification
        $user = Usersinfo::where('email', $request->email)->first();
        $user->notify(new ResetPasswordNotification($token));

        // Return back with a success message
        return back()->with('success', 'We have emailed your password reset link!');
    }
}
