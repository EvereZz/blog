<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attribytes = request()->validate([
            'name' => ['required', 'max:255' ],
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')], // добавить  игнор
            'email' => ['required', 'max:255', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', 'max:255']
        ]);

        $user = User::create($attribytes);
        
        event(new Registered($user));

        Auth::login($user);

        return redirect('email/verify')->with('success', 'Your account has been created.');
    }
}
