<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return Inertia::render('Auth/Login');
    }
    
    public function login(Request $request){
        
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Login if credentials correct
        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();

            return Inertia::location(route('dashboard'));
        }

        // Return back if credentials fail
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
