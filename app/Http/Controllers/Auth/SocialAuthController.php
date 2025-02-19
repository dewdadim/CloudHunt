<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function github(){
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect(){
        $user = Socialite::driver('github')->user();

        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'avatar' => $user->avatar,
            // 'username' => $user->nickname ?? explode('@', $user->email)[0] . (string)rand(1, 999),
            'username' => $this->generateRandomUsername(),
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
            // 'username' => $user->nickname ?? explode('@', $user->email)[0] . (string)rand(1, 999),
            'username' => $this->generateRandomUsername(),
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return Inertia::location(route('dashboard'));
    }

    private function generateRandomUsername() {
        $username = 'user' . mt_rand(1000000000, 9999999999);

        if($this->getUsername($username)) {
            return $this->generateRandomUsername();
        }

        return $username;
    }

    private function getUsername($username) {
        return User::find($username);
    }
}
