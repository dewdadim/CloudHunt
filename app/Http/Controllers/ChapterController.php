<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Module;
use App\Models\Chapter;
use Illuminate\Routing\Controller;

class ChapterController extends Controller
{
    public function show(Course $course, Chapter $chapter){
        $modules = Module::where('chapter_id', $chapter->id)->get();

        $chapters = Chapter::where('course_id', $course->id)->get();

        return Inertia::render('Course/Roadmap', [
            'course' => $course,
            'currentChapter' => $chapter,
            'chapters' => $chapters,
            'modules' => $modules
        ]);
    }
}
