<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;
use App\Http\Requests\UpdatePasswordRequest;

class PasswordController extends Controller
{
    //

    public function edit()
    {
        return view('edit-password');
    }

    public function update(UpdatePasswordRequest $request)
    {
        $userId = session('user');  // This is just the user ID (int or string)
        $user = Usersinfo::find($userId);
    
        if (!$user || !Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }
    
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return back()->with('success', 'Password updated successfully!');
    }
}
