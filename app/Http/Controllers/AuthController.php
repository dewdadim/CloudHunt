<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

/* 
*  TODO (Problems):
*
*  Problem: The username might have been taken if user try to sign up with SSO.
*
*  Solution 1: Might need to ask user to create username during onboard instead of signing up
*  Solution 2: Auto generate username then popup new user to create username (front-end)
*
*/

class AuthController extends Controller
{
    public function signup(Request $request){
        //validate request
        $fields = $request->validate([
            'username' => ['required', 'min:4', 'max:20', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8']
        ]);

        //create user
        $user = User::create($fields);

        //login
        Auth::login($user);

        //redirect
        return Inertia::location(route('dashboard'));

    }

    public function login(Request $request){
        // Validate
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

        /*
        *   TODO:
        *   1. Check if account exist. Return error if not exist
        *   2. Check if password correct. Return error if password incorrect
        */
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return Inertia::location(route('login'));
    }

    public function github(){
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect(){
        $user = Socialite::driver('github')->user();

        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'avatar' => $user->avatar,
            'username' => $user->nickname ?? explode('@', $user->email)[0] . (string)rand(1, 999),
            'full_name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return Inertia::location(route('dashboard'));
    }

    public function google(){
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect(){
        $user = Socialite::driver('google')->user();

        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'avatar' => $user->avatar,
            'full_name' => $user->name,
            'username' => $user->nickname ?? explode('@', $user->email)[0] . (string)rand(1, 999),
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return Inertia::location(route('dashboard'));
    }
}
