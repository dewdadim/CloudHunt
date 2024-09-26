<?php

namespace App\Console\Commands;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

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
    protected $description = 'Generate course directory and save relation in DB';

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * The title of the course
     * @return string
     */
    protected function getPath($name)
    {
        $name = class_basename(str_replace('\\', '/', $name));
        $name = Str::kebab($name);

        return resource_path("/js/components/courses/{$name}");
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $filesystem = new Filesystem();

        $title = $this->ask('What is the title for this course?');
        $uri = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title); // Remove symbols from title
        $uri = Str::kebab($uri); // Transform title to kebabcase format

        $path = $this->getPath($uri);

        // Save into database
        Course::create([
            'uri' => $uri,
            'title' => $title,
        ]);

        // Create the directory if it doesn't exist
        if (!file_exists($path)) {
            $filesystem->makeDirectory($path, 0755, true);
        }

        // Success message
        $this->info("Course created successfully!");
        $this->table(
            ['id', 'title', 'uri'],
            Course::all(['id', 'title', 'uri'])->toArray()
        );
    }
}
