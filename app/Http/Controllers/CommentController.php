<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    // Store a newly created comment in storage
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        // Create a new comment
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'content' => $request->content,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
