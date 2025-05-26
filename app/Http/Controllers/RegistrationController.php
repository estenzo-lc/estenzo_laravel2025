<?php

namespace App\Http\Controllers;

use App\Models\Usersinfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmail;
use App\Http\Requests\RegisterUserRequest;

class RegistrationController extends Controller
{
    /**
     * Handle user registration request.
     * Saves user to the database and sends a verification email.
     */
    public function save(RegisterUserRequest $request)
    {
        // Create a new user instance
        $user = new Usersinfo;

        // Assign user details from the validated request
        $user->id = Str::uuid(); // Generate a UUID for the user
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->sex = $request->sex;
        $user->birthday = $request->bod;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hash the password securely

        // Generate a token for email verification
        $user->verification_token = Str::random(64);

        // Save the user to the database
        $user->save();

        // Send the verification email to the user
        $user->notify(new VerifyEmail($user->verification_token));

        // Return the registration success view
        return view('registration-success', ['user' => $user]);
    }

    /**
     * Verify the user's email using the token from the email link.
     */
    public function verifyEmail($token)
    {
        // Retrieve the user by their verification token or fail
        $user = Usersinfo::where('verification_token', $token)->firstOrFail();

        // Mark the user's email as verified and clear the token
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
    }
}
