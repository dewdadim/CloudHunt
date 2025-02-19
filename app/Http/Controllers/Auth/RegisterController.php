<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function onboard() {
        $user = Auth::id();
        $user = User::findOrFail($user);
        
        return Inertia::render('Onboard/Index', compact(['user']));
    }

    public function onboardStore(Request $request){
        $fields = $request->validate([
            'full_name' => ['required', 'min:4', 'max:255'],
            'prefer_name' => ['required', 'min:4', 'max:50'],
            'date_of_birth' => ['required'],
            'occupation' => ['required'],
            'interest' => ['required'],
        ]);

        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $fields['full_name'] = ucwords(strtolower($fields['full_name']));
        $fields['prefer_name'] = ucwords(strtolower($fields['prefer_name']));

        $user->fill($fields);
        $user->save();

        return to_route('onboard.complete');
    }

    public function onboardComplete(){
        return Inertia::render('Onboard/OnboardComplete');
    }

    public function index(){
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request){
        $fields = $request->validate([
            // 'username' => ['required', 'min:4', 'max:20', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::firstOrCreate([
            'email' => $fields['email']
        ], [
            'password' => $fields['password'],
            'username' => uuid_create()
        ]);

        Auth::login($user);

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
