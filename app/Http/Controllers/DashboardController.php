<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lesson;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $lessons = Lesson::getLessonsWithUserProgress($user);
        $user_ranking = User::getAllUsersByRank();
        
        return Inertia::render('Dashboard', compact([
            'user', 
            'lessons', 
            'user_ranking'
        ]));
    }
}
