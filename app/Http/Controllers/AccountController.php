<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function show(User $user)
    {
        return view('account.show', [
            'user' => $user
        ]);
    }
    
    public function edit(User $user) 
    {
        return view('account.edit', [
            'user' => $user
        ]);
    }
    
    public function update(User $user)
    {
        $attributes = request()->validate([
            'avatar' => 'image',
            'name' => 'required',
            'username' => ['required', Rule::unique('users','username')->ignore($user)],
            'email' => ['required', Rule::unique('users','email')->ignore($user)],
            'password' => 'required|current_password'
        ]);
        
        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] = request()->file('avatar')->store('avatars');
        }
        
        $user->update($attributes);
        
        return back()->with('success', 'Account Updated!');
    }
}