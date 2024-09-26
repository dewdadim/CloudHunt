<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Module;

class CourseController extends Controller
{
    public function show(Course $course){
        $chapter = request()->chapter;
        

        $chapter = Chapter::find($chapter);
        $modules = Module::where('chapter_id', $chapter->id)->get();

        return Inertia::render('Course/Roadmap', [
            'course' => $course,
            'chapter' => $chapter,
            'modules' => $modules
        ]);
    }

    public function index(){
        $courses = Course::all();

        return Inertia::render('Courses', ['courses' => $courses]);
    }
}
