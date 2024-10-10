<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    public function show(Course $course){
        $course->load('chapters.modules');

        $modules = DB::table('modules')
                       ->join('progress', 'modules.id', '=', 'progress.module_id')
                       ->where('modules.chapter_id', '=', $course->chatpers)
                       ->get();
        // dd($modules);
        // dd($course->chapters);
        return Inertia::render('Course/Roadmap', [
            'course' => $course, 
            'chapters'=> $course->chapters
        ]);
    }

    public function index(){
        $courses = Course::all();

        return Inertia::render('Courses', ['courses' => $courses]);
    }

    public function showModule(Course $course, Chapter $chapter, Module $module){

        return Inertia::render('Course/Module', [
            'course' => $course,
            'chapter' => $chapter,
            'module' => $module,
        ]);
    }
}
