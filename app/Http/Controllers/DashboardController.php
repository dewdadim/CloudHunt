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

        // Fetch all lessons and their modules
        $lessons = Lesson::with('modules')
                        ->whereHas('modules.progresses', function($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })
                        ->get();

        // Fetch all progress for the user
        $progresses = Progress::where('user_id', $user->id)
                            ->orderBy('updated_at', 'desc')  // Sort by the most recently updated
                            ->get()
                            ->groupBy('lesson_id');  // Group progress by lesson_id

        // Combine lessons, modules, and progress into one structure
        $lessonsWithProgress = $lessons->map(function($lesson) use ($progresses) {
            // Fetch the progress for this lesson
            $lessonProgress = $progresses->get($lesson->id) ?? collect();

            // Map over each module and inject progress (completed status)
            $modulesWithProgress = $lesson->modules->map(function($module) use ($lessonProgress) {
                return [
                    'id' => $module->id,
                    'title' => $module->title,
                    'completed' => optional($lessonProgress->firstWhere('module_id', $module->id))->completed ?? false,  // Include progress if exists
                    'updated_at' => optional($lessonProgress->firstWhere('module_id', $module->id))->updated_at ?? null,  // Include progress update timestamp
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

        // Sort lessons by most recently updated progress
        $sortedLessons = $lessonsWithProgress->sortByDesc(function($lesson) {
            return collect($lesson['modules'])->max('updated_at');  // Sort lessons by most recent module progress update
        });

        // Pass the lessons array to the frontend
        return Inertia::render('Dashboard', [
            'lessons' => $sortedLessons->values()->toArray()  // Pass an array of lessons
        ]);
    }
}
