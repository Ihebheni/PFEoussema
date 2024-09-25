<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;

class FollowController extends Controller
{
    public function follow($id)
{
    $user = auth()->user();
    $coach = User::findOrFail($id);

    // Check if the user is already following this coach
    if (!$user->followings->contains($coach->id)) {
        // Create a new follow record
        Follow::create([
            'follower_id' => $user->id,
            'following_id' => $coach->id,
        ]);
    }else {
        return redirect()->back()->with('error', 'You are aleaready following this coach.');

    }

    return redirect()->back()->with('message', 'You are now following this coach.');
}

    public function unfollow($id)
    {
        $user = auth()->user();
        $coach = User::findOrFail($id);

        // Find the follow record and delete it
        $follow = Follow::where('follower_id', $user->id)
                        ->where('following_id', $coach->id)
                        ->first();

        if ($follow) {
            $follow->delete();
        }

        return redirect()->back()->with('message', 'You have unfollowed this coach.');
    }
}
