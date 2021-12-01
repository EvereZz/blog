<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Subscriber;

class SubscribersController extends Controller
{
    public function store(Request $request) 
    {
        $attributes= $request->validate([
            'email' => ['required', Rule::unique('subscribers','email')]
            ]);
        
        Subscriber::create($attributes);
        
        return back()->with('success', 'You now Subscribed!');
    }
    
    public function edit() 
    {
        return view('components.unsubscribe-form');
    }
    
    public function destroy(Request $request) 
    {
        $subscriber = $request->validate([
            'email' => ['required', Rule::exists('subscribers','email')]
        ]);
            
        Subscriber::where('email', $subscriber['email'])->get()->first()->delete();
        
        return back()->with('success' , 'You Unsubscribed.');
    }
}
