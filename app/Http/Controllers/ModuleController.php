<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Module;
use App\Models\Chapter;
use Illuminate\Routing\Controller;

class ModuleController extends Controller
{
    public function show(Course $course, Chapter $chapter, Module $module){

        return Inertia::render('Course/Module', [
            'course' => $course,
            'chapter' => $chapter,
            'module' => $module
        ]);
    }
}
