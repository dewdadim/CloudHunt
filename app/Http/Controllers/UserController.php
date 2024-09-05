<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function onboard(Request $request){
        //validate request
        $fields = $request->validate([
            'full_name' => ['required', 'min:4', 'max:255'],
            'prefer_name' => ['required', 'min:4', 'max:50'],
            'date_of_birth' => ['required'],
        ]);

        // Get current user
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        // Fill user model
        $user->fill($fields);

        // Save user to database
        $user->save();

        // Redirect to route
        return redirect()->route('home');
    }
}
