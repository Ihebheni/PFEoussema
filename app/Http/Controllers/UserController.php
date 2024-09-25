<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

           /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private function getAuthenticatedUser()
    {
        return auth()->user();
    }
    public function index()
    {
        $user = $this->getAuthenticatedUser();
        return view('user.dashboard', ['user'=>$user]);
    }



    //

    public function users()
    {
        // Fetch all users with the role 'user'
        $normalusers = User::where('role', 'user')->get();
        $user = $this->getAuthenticatedUser();

        return view('admin.sections.users.users', [
            'normalusers' => $normalusers , 'user'=>$user ,
        ]);
    }


      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the normaluser by ID
        $normaluser = User::findOrFail($id);

        // Delete profile photo if it exists
        if ($normaluser->profile_photo) {
            // Ensure the file exists before attempting to delete
            if (Storage::exists($normaluser->profile_photo)) {
                Storage::delete($normaluser->profile_photo);
            }
        }

        // Delete couverture pic if it exists
        if ($normaluser->couverture_pic) {
            // Ensure the file exists before attempting to delete
            if (Storage::exists($normaluser->couverture_pic)) {
                Storage::delete($normaluser->couverture_pic);
            }
        }

        // Delete the normaluser record
        $normaluser->delete();

        // Redirect back with a success message
         return redirect()->back()->with('success', 'normaluser deleted successfully.');
    }


    // Show the form for creating a new normaluser
    public function create()
    {
        $user = $this->getAuthenticatedUser();

        return view('admin.sections.users.createnormaluser', ['user'=>$user]);
    }

    // Store a newly created normaluser in storage
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'secondname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'couverture_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'sexe' => 'required|in:male,female',

        ]);

        // Handle file uploads
        $profilePhotoPath = $request->file('profile_photo') ? $request->file('profile_photo')->store('profile_photos') : null;
        $couverturePicPath = $request->file('couverture_pic') ? $request->file('couverture_pic')->store('couverture_pics') : null;

        // Create the new normaluser
        $normaluser = User::create([
            'name' => $request->input('name'),
            'secondname' => $request->input('secondname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'profile_photo' => $profilePhotoPath,
            'couverture_pic' => $couverturePicPath,
            'password' => Hash::make($request->input('password')),
            'role' => 'user',
            'email_subscription'=> 0 ,
            'accepted_terms'=> true,
            'sexe' => $request->input('sexe'),

        ]);
        // Redirect to the list of normaluseres with a success message
        return Redirect::route('admin.users.index')->with('success', 'normaluser created successfully.');
    }







    public function show($id)
    {
        $user = $this->getAuthenticatedUser();

        // Retrieve the normaluser and include related data
        $normaluser = User::with(['posts', 'followers', 'followings', 'enrolledCourses'])
                     ->findOrFail($id);

        return view('shownormaluser', [
            'normaluser' => $normaluser,
            'user' => $user
        ]);
    }


}
