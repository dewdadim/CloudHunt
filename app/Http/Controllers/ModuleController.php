<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function show(Lesson $lesson, Module $module){

        $userId = Auth::id();

        Progress::firstOrCreate([
            'module_id' => $module->id
        ],[
            'module_id' => $module->id,
            'user_id' => $userId,
            'lesson_id' => $lesson->id,
            'completed' => true
        ]);

        return Inertia::render('Lesson/Module', [
            'lesson' => $lesson,
            'module' => $module
        ]);
    }

    public function completeModule(Request $request, $moduleId){
        $user = auth()->user;
        $module = Module::findOrFail($moduleId);

        $user->completedModules()->syncWithoutDetaching([
            $module->id => ['completed' => true]
        ]);

        return response()->json(['message' => 'Module completed!'], 200);
    }
}
