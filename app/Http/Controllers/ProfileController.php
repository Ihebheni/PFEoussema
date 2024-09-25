<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
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

    public function profile(){
        $user = $this->getAuthenticatedUser();

        if ($user) {
            // Redirect based on the user's role
            switch ($user->role) {
                case 'admin':
                    return view('admin.sections.profile',['user'=>$user ]);
                case 'coach':
                    return view('coach.sections.profile',['user'=>$user]);
                case 'user':
                    return view('user.sections.profile',['user'=>$user]);
                default:
                    return redirect()->route('index');
            }
        } else {
            return redirect()->back();
        }

    }

     // Update profile
     public function update(Request $request, $id)
     {
         $user = User::findOrFail($id);

         // Validate the request
         $request->validate([
             'email' => 'required|email',
             'phone' => 'nullable|string',
             'profile_photo' => 'nullable|image|max:2048',
             'couverture_pic' => 'nullable|image|max:2048',
             'facebook' => 'nullable|url',
             'twitter' => 'nullable|url',
             'instagram' => 'nullable|url',
             'linkedin' => 'nullable|url',
             'cin' => 'nullable|string',
             'attendance_mode' => 'nullable|string',
             'occupation' => 'nullable|string',
             'sector' => 'nullable|string',
             'activity_description' => 'nullable|string',
             'civility' => 'nullable|string',
             'gender' => 'nullable|string',
         ]);

         $data = $request->only([
             'email', 'phone', 'facebook', 'twitter', 'instagram', 'linkedin',
             'cin', 'attendance_mode', 'occupation', 'sector', 'activity_description',
             'civility', 'gender'
         ]);

         // Handle profile photo upload
         if ($request->hasFile('profile_photo')) {
             // Delete old profile photo if exists
             if ($user->profile_photo) {
                 Storage::disk('public')->delete($user->profile_photo);
             }
             // Save new profile photo
             $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
         }

         // Handle cover image upload
         if ($request->hasFile('couverture_pic')) {
             // Delete old cover image if exists
             if ($user->couverture_pic) {
                 Storage::disk('public')->delete($user->couverture_pic);
             }
             // Save new cover image
             $data['couverture_pic'] = $request->file('couverture_pic')->store('couverture_pics', 'public');
         }

         // Update the user with the new data
         $user->update($data);

         return redirect()->back()->with('success', 'Profile updated successfully');
     }

     // Update personal information
     public function updatePersonalInfo(Request $request, $id)
     {
         $user = User::findOrFail($id);

         // Validate the request
         $request->validate([
             'name' => 'required|string',
             'secondname' => 'required|string',
             'city' => 'nullable|string',
             'country' => 'nullable|string',
         ]);

         // Update personal information
         $user->update($request->only(['name', 'secondname', 'city', 'country']));

         return redirect()->back()->with('success', 'Personal information updated successfully');
     }

     public function changePassword(Request $request, $id)
     {
         $user = User::findOrFail($id);

         // Validate the request
         $request->validate([
             'current_password' => 'required',
             'new_password' => 'required|min:8|confirmed',
         ]);

         // Check current password
         if (!Hash::check($request->current_password, $user->password)) {
             return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
         }

         // Update new password
         $user->password = Hash::make($request->new_password);
         $user->save();

         return redirect()->back()->with('success', 'Password changed successfully');
     }


     // Delete account
     public function destroy(Request $request , $id)
     {
         $user = User::findOrFail($id);

         // Delete profile photo
         if ($user->profile_photo) {
             Storage::delete('public/' . $user->profile_photo);
         }
         Auth::logout();

         // Delete user account
         $user->delete();

         $request->session()->invalidate();
         $request->session()->regenerateToken();
         return Redirect::to('/')->with('success', 'Account deleted successfully');
     }

}
