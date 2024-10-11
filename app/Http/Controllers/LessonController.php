<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function show(Lesson $lesson) {

        $lesson->load('modules');

        return Inertia::render('Lesson/Roadmap', [
            'lesson' => $lesson
        ]);
    }

    public function index() {
        $lessons = Lesson::all();

        return Inertia::render('Lessons', [
            'lessons' => $lessons
        ]);
    }
}
