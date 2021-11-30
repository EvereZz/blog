<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller {

    public function show() 
    {
        return view('sessions.verify-email');
    }

    public function store(EmailVerificationRequest $request) 
    {
        $request->fulfill();

        return redirect('/')->with('success', 'Email Verified!');
    }
    
    public function update(Request $request) 
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
