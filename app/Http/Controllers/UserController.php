<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show(User $user){

        abort(404);
        return Inertia::render('Profile', ['user' => $user]);
    }

    public function onboard(Request $request){
        //validate request
        $fields = $request->validate([
            'full_name' => ['required', 'min:4', 'max:255'],
            'prefer_name' => ['required', 'min:4', 'max:50'],
            'date_of_birth' => ['required'],
            'occupation' => ['required'],
            'interest' => ['required'],
        ]);

        // Get current user
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        // Format name
        $fields['full_name'] = ucwords(strtolower($fields['full_name']));
        $fields['prefer_name'] = ucwords(strtolower($fields['prefer_name']));

        // Fill user model
        $user->fill($fields);

        // Save user to database
        $user->save();

        return to_route('onboard.complete');
    }

    public function createUsername(Request $request) {
        // Validate request
        $fields = $request->validate([
            'username' => ['required', 'min:4', 'max:20', 'unique:users']
        ]);

        // Get current user
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        // Fill user model
        $user->fill($fields);

        // Save user to database
        $user->save();

        return;
    }
}
