<?php

namespace App\Console\Commands;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class CreateCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:course';

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

        $title = $this->ask('What is the title for this course?');
        $uri = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title); // Remove symbols from title
        $uri = Str::kebab($uri); // Transform title to kebabcase format

        // Save into database
        Course::create([
            'uri' => $uri,
            'title' => $title,
        ]);

        // Success message
        $this->info("Course created successfully!");
        $this->table(
            ['id', 'title', 'uri'],
            Course::all(['id', 'title', 'uri'])->toArray()
        );
    }
}
