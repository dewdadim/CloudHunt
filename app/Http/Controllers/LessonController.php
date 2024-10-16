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
                            ->where('lesson_id', $lesson->id)
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

            // Fetch all lessons and their modules
            $lessons = Lesson::with('modules')->get();  // Fetch lessons with their modules

            // Fetch all progress for the user
            $progresses = Progress::where('user_id', $user->id)
                                ->get()
                                ->groupBy('lesson_id');  // Group progress by lesson_id

            // Combine lessons, modules, and progress into one structure
            $lessonsWithProgress = $lessons->map(function($lesson) use ($progresses, $user) {
                // Fetch the progress for this lesson
                $lessonProgress = $progresses->get($lesson->id) ?? collect();

                // Map over each module and inject progress (completed status)
                $modulesWithProgress = $lesson->modules->map(function($module) use ($lessonProgress) {
                    return [
                        'id' => $module->id,
                        'title' => $module->title,
                        'completed' => optional($lessonProgress->firstWhere('module_id', $module->id))->completed ?? false,  // Include progress if exists
                    ];
                });

                // Return the lesson structure with modules and progress
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'uri' => $lesson->uri,
                    'modules' => $modulesWithProgress->toArray(),  // Nested modules with progress
                ];
            });

        return Inertia::render('Lessons', [
            'lessons' => $lessonsWithProgress->toArray()
        ]);
    }
}
