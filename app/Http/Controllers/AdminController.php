<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.dashboard',[
             'user' => $this->getAuthenticatedUser(),
    ]);
    }
}
