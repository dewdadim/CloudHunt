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

        $modules = $lesson->modules()->get();

        $progresses = Progress::where('user_id', $user->id)
                            ->get()
                            ->keyBy('module_id');

        // Combine modules and progress into one structure
        $modulesWithProgress = $modules->map(function($module) use ($progresses) {
        return [
                'id' => $module->id,
                'title' => $module->title,
                'description' => $module->description,
                'uri' => $module->uri,
                'completed' => optional($progresses->get($module->id))->completed ?? false,  // Include progress if exists, default to false    
            ];
        });

        return Inertia::render('Lesson/Roadmap', [
            'lesson' => $lesson,
            'modules' => $modulesWithProgress,
        ]);
    }

    public function index() {
        $user = Auth::user();

        // Fetch all lessons with their modules
        $lessons = Lesson::with(['modules' => function($query) {
            $query->select('id', 'lesson_id', 'title', 'uri');
        }])->get();

        // Get progress for the current user
        $progresses = Progress::where('user_id', $user->id)
            ->get()
            ->keyBy('module_id');

        // Transform lessons data
        $lessonsWithProgress = $lessons->map(function($lesson) use ($progresses) {
            $modulesWithProgress = $lesson->modules->map(function($module) use ($progresses) {
                return [
                    'id' => $module->id,
                    'title' => $module->title,
                    'uri' => $module->uri,
                    'completed' => optional($progresses->get($module->id))->completed ?? false,
                ];
            });

            return [
                'id' => $lesson->id,
                'title' => $lesson->title,
                'uri' => $lesson->uri,
                'modules' => $modulesWithProgress,
            ];
        });

        return Inertia::render('Lessons', [
            'lessons' => $lessonsWithProgress
        ]);
    }
}
