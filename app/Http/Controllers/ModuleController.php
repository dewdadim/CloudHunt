<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function show(Lesson $lesson, Module $module){

        $userId = Auth::id();

        $modules = $lesson->modules()->get();
        // dd($modules);
        foreach ($modules as $i) {
            Progress::firstOrCreate([
                'user_id' => $userId,
                'module_id' => $i->id
            ],[
                'completed' => false
            ]);
        };

        return Inertia::render('Lesson/Module', [
            'lesson' => $lesson,
            'module' => $module
        ]);
    }

    public function completeModule(Lesson $lesson, Module $module){
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        // Get existing progress
        $progress = Progress::where('user_id', $userId)
            ->where('module_id', $module->id)
            ->first();

        // Only set completed_at if it's null (first time completion)
        $attributes = [
            'completed' => true,
            'completed_at' => $progress && $progress->completed_at ? $progress->completed_at : now(),
        ];

        $user->progresses()->syncWithoutDetaching([
            $module->id => $attributes
        ]);

        return Inertia::render('Lesson/LessonComplete', [
            'lesson' => $lesson,
            'module' => $module
        ]);
    }
}
