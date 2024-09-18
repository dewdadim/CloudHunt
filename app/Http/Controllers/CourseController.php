<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;

class CourseController extends Controller
{
    public function show(Course $course){

        return Inertia::render('Course/Roadmap', ['course' => $course]);
    }

    public function index(){
        $courses = Course::all();

        return Inertia::render('Courses', ['courses' => $courses]);
    }
}
