<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lesson;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        $lessons = Lesson::with(['modules' => function($query) use ($user) {
            $query->select('modules.*')
                  ->selectRaw('COALESCE(progresses.completed, false) as completed')
                  ->leftJoin('progresses', function($join) use ($user) {
                      $join->on('modules.id', '=', 'progresses.module_id')
                           ->where('progresses.user_id', '=', $user->id);
                  });
        }])
        ->whereHas('modules.progresses', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->get()
        ->map(function($lesson) {
            return [
                'id' => $lesson->id,
                'title' => $lesson->title, 
                'uri' => $lesson->uri,
                'modules' => $lesson->modules->toArray()
            ];
        })->toArray();

        return Inertia::render('Dashboard', [
            'lessons' => $lessons
        ]);
    }
}
