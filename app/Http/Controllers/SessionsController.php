<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.login');
    }
    
    public function store()
    {
        $attribytes = request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (! Auth::attempt($attribytes))
        {
            throw ValidationException::withMessages(['email' => 'Your provided credentials could not be verified.']);
            
        }

        session()->regenerate();

        return redirect('/')->with('success', "Welcome Back!");

    }
    
     public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', "Goodbye!");
    }
}
