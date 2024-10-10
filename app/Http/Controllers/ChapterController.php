<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Module;
use App\Models\Chapter;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\JoinClause;

class ChapterController extends Controller
{
    public function show(Course $course, Chapter $chapter){
        $modules = DB::table('modules')
                        ->leftJoin('progress', 'modules.id', '=', 'progress.module_id')
                        ->where('progress.user_id', '=', Auth::id())
                        ->where('modules.chapter_id', '=', $chapter->id)
                        ->get();

        // $progress = DB::table('progress')
        //                 ->join('users')

        return dd($modules);
        return Inertia::render('Course/Roadmap', [
            'course' => $course,
            'chapter' => $chapter,
            'modules' => $modules
        ]);
    }
}
