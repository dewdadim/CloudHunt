<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function completeModule(Lesson $lesson, Module $module, Request $request){
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->validate([
            'time_spent' => 'required|integer',
            'accuracy' => 'integer',
            'xp_earned' => 'required|integer'
        ]);

        // Get existing progress
        $progress = Progress::where('user_id', $userId)
            ->where('module_id', $module->id)
            ->first();

        // Only set completed_at if it's null (first time completion)
        $attributes = [
            'completed' => true,
            'completed_at' => $progress && $progress->completed_at ? $progress->completed_at : now(),
            'xp_earned' => $data['xp_earned'],
            'time_spent' => $data['time_spent'],
            'accuracy' => $data['accuracy'],
        ];

        $user->progresses()->syncWithoutDetaching([
            $module->id => $attributes
        ]);

        // Update user's total XP
        $user->increment('xp', $data['xp_earned']);

        return Inertia::render('Lesson/LessonComplete', [
            'lesson' => $lesson,
            'module' => $module,
            'time_spent' => $data['time_spent'],
            'accuracy' => $data['accuracy'],
            'xp_earned' => $data['xp_earned']
        ]);
    }
}
