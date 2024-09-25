<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post; // Assuming you have a Post model
use App\Models\User;
use Illuminate\Http\Request;
class ActualityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch posts with comments
        $posts = Post::with('user', 'comments')->when($search, function ($query, $search) {
            $query->where('content', 'like', "%{$search}%");
        })->latest()->get();

        // Fetch courses
        $courses = Course::when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        })->latest()->get();


        $user = auth()->user();
        return view('actuallity', compact('posts', 'courses', 'user', 'search'));
    }
}
