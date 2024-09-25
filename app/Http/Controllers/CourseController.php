<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('createcouse' , ["user"=>$user]);
    }

    public function store(Request $request)
{
    $request->validate([
        'coach_id' => 'required|exists:users,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|string|max:50',
        'picture.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Traitez l'upload des images si nécessaire
    if ($request->hasFile('picture')) {
        $pictures = [];
        foreach ($request->file('picture') as $file) {
            $path = $file->store('course_pictures', 'public');
            $pictures[] = $path;
        }
    }

    // Créez le cours
    Course::create([
        'coach_id' => $request->coach_id,
        'title' => $request->title,
        'description' => $request->description,
        'duration' => $request->duration,
        'picture' => isset($pictures) ? json_encode($pictures) : null,
    ]);

    return redirect()->back()->with('success', 'Course created successfully!');
}

}
