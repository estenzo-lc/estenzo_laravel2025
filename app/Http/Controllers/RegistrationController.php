<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Usersinfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmail;
class RegistrationController extends Controller
{
    //

    public function save(RegisterUserRequest $request)
    {
        $user = new Usersinfo;
        $user->id = \Str::uuid();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->sex = $request->sex;
        $user->birthday = $request->bod;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->verification_token = \Str::random(64);
        $user->save();

        $user->notify(new VerifyEmail($user->verification_token));

        return view('registration-success', ['user' => $user]);


    }

    public function verifyEmail($token)
    {
        $user = Usersinfo::where('verification_token', $token)->firstOrFail();
    
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();
    
        return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
    }
    

}
