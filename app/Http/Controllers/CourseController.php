<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Module;

class CourseController extends Controller
{

    public function show(Course $course){
        $chapter = Chapter::select('uri')->where('course_id', $course->id)->first();
        
        return to_route('chapters.show', [
            'course' => $course, 'chapter'=> $chapter
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
