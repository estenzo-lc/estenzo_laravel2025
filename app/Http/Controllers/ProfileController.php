<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        return view('edit-profile');
    }

    /**
     * Handle the profile update request.
     */
    public function update(UpdateProfileRequest $request)
    {
        // Retrieve the currently logged-in user using the session ID
        $user = Usersinfo::find(session('user')->id);

        // Proceed if the user is found
        if ($user) {
            // Update the user's profile information
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->save();

            // Update the session with the new user data
            session(['user' => $user]);

            // Return back with a success message
            return back()->with('success', 'Profile updated successfully!');
        }

        // If user not found, return an error
        return back()->withErrors(['user' => 'User not found.']);
    }
}
