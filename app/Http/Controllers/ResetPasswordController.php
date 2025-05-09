<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;
use App\Notifications\ResetForgottenPasswordNotification;


class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usersinfo,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid or expired reset token.']);
        }

        $user = Usersinfo::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Send notification
        $user->notify(new ResetForgottenPasswordNotification());

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset successfully!');
    }
}

