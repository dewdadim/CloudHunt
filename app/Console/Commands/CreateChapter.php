<?php

namespace App\Console\Commands;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Console\Command;

class CreateChapter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:chapter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $courses = Course::all();
        $course = $this->choice('What course this module belongs to?', array_column(json_decode($courses), 'title'));
        $courseId = Course::where('title', $course)->pluck('id')->first();

        $title = $this->ask('What is the title for this chapter?');

        // Save into database
        Chapter::create([
            'title' => $title,
            'course_id' => $courseId,
        ]);

        // Success message
        $this->info("Chapter for {$course} created successfully!");
        $this->table(
            ['id', 'title'],
            Chapter::select('id', 'title')->where('course_id', $courseId)->get()
        );
    
    }
}
