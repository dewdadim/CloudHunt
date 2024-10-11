<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function show(Lesson $lesson) {

        $user = Auth::user();

        $progress = Progress::where('user_id', $user->id)
                            ->where('lesson_id', $lesson->id)
                            ->get()
                            ->keyBy('module_id');

        return Inertia::render('Lesson/Roadmap', [
            'lesson' => $lesson->load('modules'),
            'progress' => $progress
        ]);
    }

    public function index() {
        $lessons = Lesson::all();

        return Inertia::render('Lessons', [
            'lessons' => $lessons
        ]);
    }
}
