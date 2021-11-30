<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function create() 
    {
        return view('sessions.forgot-password');
    }
    
    public function store(Request $request) 
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
        $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('success', 'Reset link was sent to your email address.')
                    : back()->withErrors(['email' => __($status)]);
    }
    
    public function edit($token) 
    {
        return view('sessions.reset-password', [
            'token' => $token
        ]);
    }
    
    public function update(Request $request)
    {
        $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:7|max:255|confirmed',
    ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
        }
    );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', 'Password Changed!')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
