<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\RegistrationNotification; // Make sure this class exists and is imported
use App\Models\Usersinfo;

class RegistrationNotificationController extends Controller
{
    /**
     * Send a registration-related notification to the user.
     * This assumes the user is authenticated or accessible via session/request.
     */
    public function store(Request $request)
    {
        // Retrieve the user to notify (adjust as needed based on your logic)
        $user = Usersinfo::find(session('user')->id); // or $request->user() if using auth()

        if (!$user) {
            return back()->withErrors(['user' => 'User not found.']);
        }

        // Send the registration notification to the user
        $user->notify(new RegistrationNotification());

        return back()->with('success', 'Notification sent successfully.');
    }
}
