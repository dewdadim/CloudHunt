<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;
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
                'lesson_id' => $lesson->id,
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

        $user->progresses()->syncWithoutDetaching([
            $module->id => ['completed' => true]
        ]);

        return response()->json(['message' => 'Module completed!'], 200);
    }
}
