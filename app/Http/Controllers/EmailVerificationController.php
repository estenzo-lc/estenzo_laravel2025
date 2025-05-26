<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Usersinfo;
use App\Notifications\EmailVerificationNotification;

class EmailVerificationController extends Controller
{
    /**
     * Display the form where users can request a verification email.
     */
    public function showVerificationForm()
    {
        return view('verify-request');
    }

    /**
     * Send a verification email to the user.
     */
    public function sendVerificationEmail(Request $request)
    {
        // Validate the email input: required, valid email format, and must exist in the usersinfo table
        $request->validate([
            'email' => 'required|email|exists:usersinfo,email',
        ]);

        // Retrieve the user record by email
        $user = Usersinfo::where('email', $request->email)->first();

        // Check if the user is already verified
        if ($user->email_verified_at) {
            return back()->with('success', 'Your email is already verified.');
        }

        // Generate a new verification token
        $user->verification_token = Str::random(60);
        $user->save();

        // Send the email verification notification
        $user->notify(new EmailVerificationNotification($user->verification_token));

        // Redirect back with a success message
        return back()->with('success', 'Verification email sent! Please check your inbox.');
    }

    /**
     * Verify the user's email using the token from the email link.
     */
    public function verifyToken($token)
    {
        // Find the user by the verification token or fail with 404
        $user = Usersinfo::where('verification_token', $token)->firstOrFail();

        // Mark the user's email as verified and remove the token
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        // Redirect to login with a success message
        return redirect()->route('login')->with('success', 'Email verified successfully!');
    }
}
