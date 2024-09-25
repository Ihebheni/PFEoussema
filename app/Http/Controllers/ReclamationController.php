<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ReclamationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $isUser = User::where('email', $request->input('user_email'))->exists();

        Reclamation::create([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            'text' => $request->input('user_message'),
            'is_user' => $isUser,
        ]);

        return response()->json(['success' => 'Message Sent'], 200);
    }
    public function reclamations()
    {
        $user = auth()->user();
        $reclamations = Reclamation::all();

        return view('admin.sections.reclamations.reclamations', [
            "user" => $user,
            "reclamations" => $reclamations
        ]);
    }

    // Show a single reclamation
    public function show($id)
    {
        $reclamation = Reclamation::findOrFail($id);
        $user = auth()->user();
        if ($reclamation->read == false) {
            $reclamation->read = true;
            $reclamation->save();
        }

        return view('admin.sections.reclamations.showreclamation', [
            "user" => $user,
            "reclamation" => $reclamation,
        ]);
    }

    // Delete a reclamation
    public function delete($id)
    {
        $reclamation = Reclamation::findOrFail($id);
        $reclamation->delete();

        return redirect()->route('admin.reclamations')->with('success', 'Reclamation deleted successfully.');
    }


    
}
