<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

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
    protected $description = 'Generate chapter directory and save relation in DB';

    /**
     * Get the destination class path.
     *
     * @param  string  $course
     * The title of the course
     * @param  string  $name
     * The title of the chapter
     * @return string
     */
    protected function getPath($course, $name)
    {
        $name = class_basename(str_replace('\\', '/', $name));
        $course = Str::kebab($course); 
        $name = Str::kebab($name);

        return resource_path("/js/components/courses/{$course}/{$name}");
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filesystem = new Filesystem();

        $courses = Course::all();
        $course = $this->choice('What course this module belongs to?', array_column(json_decode($courses), 'title'));
        $courseId = Course::where('title', $course)->pluck('id')->first();

        $title = $this->ask('What is the title for this chapter?');
        $uri = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title); // Remove symbols from title
        $uri = Str::kebab($uri); // Transform title to kebabcase format

        $path = $this->getPath($course, $uri);

        // Save into database
        Chapter::create([
            'title' => $title,
            'course_id' => $courseId,
        ]);

        // Create the directory if it doesn't exist
        if (!file_exists($path)) {
            $filesystem->makeDirectory($path, 0755, true);
        }

        // Success message
        $this->info("Chapter for {$course} created successfully!");
        $this->table(
            ['id', 'title'],
            Chapter::select('id', 'title')->where('course_id', $courseId)->get()
        );
    
    }
}
