<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $userId = session('user');
        
        if (!$userId) {
            return redirect()->route('login')->withErrors(['session' => 'You must be logged in.']);
        }
    
        $user = Usersinfo::find($userId);
    
        if (!$user) {
            return redirect()->route('login')->withErrors(['session' => 'User not found.']);
        }
    
        return view('edit-profile', compact('user'));
    }
    

    public function update(UpdateProfileRequest $request)
    {
        $userId = session('user');
        $user = Usersinfo::find($userId);
    
        if ($user) {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->save();
    
            // No need to update session with full user object
            return back()->with('success', 'Profile updated successfully!');
        }
    
        return back()->withErrors(['user' => 'User not found.']);
    }
    
}
