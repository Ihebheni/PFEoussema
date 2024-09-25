<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{

    public function create(){
        $user = auth()->user() ;
        return view('createpost' , ["user"=>$user]);
    }

    public function show($id){
        $user = auth()->user() ;
        $post = Post::findOrFail($id);
        return view('showpost', ["user"=>$user , "post"=>$post]);

    }


    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'content' => 'required|string|max:500',
            'post_pics.*' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Create a new post
        $post = new Post;
        $post->user_id = Auth::id(); // The currently authenticated user's ID
        $post->content = $request->input('content');

        // Handle file uploads (multiple images)
        if ($request->hasFile('post_pics')) {
            $images = [];
            foreach ($request->file('post_pics') as $file) {
                // Store each file and get the file path
                $path = $file->store('public/posts');
                $images[] = basename($path);
            }
            $post->post_pics = json_encode($images); // Store images as a JSON array
        }

        // Save the post to the database
        $post->save();

        // Redirect back or to a specific page
        return redirect()->back()->with('success', 'Post created successfully!');
    }




public function destroy($id)
{
    $post = Post::findOrFail($id);
    $user = auth()->user() ;

    // Delete post images if they exist
    if ($post->post_pics) {
        $images = json_decode($post->post_pics);
        foreach ($images as $image) {
            // Construct the path to the image
            $imagePath = 'posts/' . $image;

            // Delete the image from storage
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
    }

    // Delete the post itself
    $post->delete();

    return redirect()->route('profile', $user->id)->with('success', 'Post deleted successfully');
}

public function edit($id)
{
    $user = auth()->user() ;

    $post = Post::findOrFail($id);
    return view('posts.edit', ["post"=>$post , "user"=>$user]);
}


public function update(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string',
        'post_pics.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for images
    ]);

    $post = Post::findOrFail($id);
    $post->content = $request->input('content');

    // Handle file uploads
    if ($request->hasFile('post_pics')) {
        $existingImages = json_decode($post->post_pics, true) ?? [];

        // Delete existing images from storage
        foreach ($existingImages as $image) {
            $imagePath = 'posts/' . $image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        // Save new images
        $newImages = [];
        foreach ($request->file('post_pics') as $file) {
            $filename = $file->store('posts', 'public');
            $newImages[] = basename($filename);
        }
        $post->post_pics = json_encode($newImages);
    }

    $post->save();

    return redirect()->back()->with('success', 'Post updated successfully');
}


}
