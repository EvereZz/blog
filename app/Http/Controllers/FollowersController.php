<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;

class FollowersController extends Controller
{
    public function show(User $user)
    {   
        return view('account.followings', [
            'user' => $user
        ]);
    }
    
    public function store(User $user, Request $request)
    {   
        Follower::create([
            'follower_id' => $request->user()->id,
            'following_id' => $user->id
        ]);
        
        return back()->with('success' , 'Now you follow!');
    }
    
    public function destroy(User $user) 
    {
        $follower = auth()->user()->followings->where('following_id', $user->id)->first();
        
        $follower->delete();
        
        return back()->with('success' , 'You unfollowed.');
    }
}
