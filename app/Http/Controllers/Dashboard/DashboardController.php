<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Lesson;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
