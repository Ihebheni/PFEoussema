<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'secondname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:coach,user',
            'sexe' => 'required|in:male,female',
            'civility' => 'nullable|in:Mr,Ms,Dr,Prof',
            'phone' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'couverture_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'occupation' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'accepted_terms' => ['required', 'boolean'],
        ]);

        // Handle file uploads
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $couverturePicPath = null;
        if ($request->hasFile('couverture_pic')) {
            $couverturePicPath = $request->file('couverture_pic')->store('couverture_pics', 'public');
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'secondname' => $request->secondname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'sexe' => $request->sexe,
            'civility' => $request->civility,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'profile_photo' => $profilePhotoPath,
            'couverture_pic' => $couverturePicPath,
            'occupation' => $request->occupation,
            'company_name' => $request->company_name,
            'email_subscription' => false,
            'accepted_terms' => $request->accepted_terms,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on the user's role
        switch ($user->role) {
          
            case 'coach':
                return redirect()->route('coach.dashboard');
            case 'user':
                return redirect()->route('user.dashboard');
            default:
                return redirect()->back()->with('error' , 'somethings wrong'); // Default redirection if role is not recognized
        }
    }

}
