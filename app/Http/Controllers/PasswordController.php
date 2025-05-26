<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;
use App\Http\Requests\UpdatePasswordRequest;
use App\Notifications\ChangePasswordNotification;

class PasswordController extends Controller
{
    /**
     * Show the password update form.
     */
    public function edit()
    {
        return view('edit-password');
    }

    /**
     * Handle the password update request.
     */
    public function update(UpdatePasswordRequest $request)
    {
        // Retrieve the currently logged-in user using the session
        $user = Usersinfo::find(session('user')->id);
    
        // Check if the user exists and the old password matches the current password
        if (!$user || !Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }
    
        // Update the user's password with the new hashed password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Notify the user that their password has been changed
        $user->notify(new ChangePasswordNotification());
    
        // Return back with a success message
        return back()->with('success', 'Password updated successfully!');
    }
}
