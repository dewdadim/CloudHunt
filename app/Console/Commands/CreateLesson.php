<?php

namespace App\Console\Commands;

use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateLesson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:lesson';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate lesson directory and save relation in DB';

    /**
     * Get the destination class path.
     *
     * @param  string  $name The title of the lesson
     * 
     * @return string
     */
    protected function getPath($name)
    {
        $name = class_basename(str_replace('\\', '/', $name));
        $name = Str::kebab($name);

        return resource_path("/js/components/lessons/{$name}");
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $filesystem = new Filesystem();

        $title = $this->ask('What is the title for this lesson?');
        $title = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title); // Remove symbols from title
        $uri = Str::kebab($title); // Transform title to kebabcase format

        $description = $this->ask('Description for this lesson', null);

        $path = $this->getPath($uri);

        // Save into database
        Lesson::create([
            'uri' => $uri,
            'title' => $title,
            'description' => $description
        ]);

        // Create the directory if it doesn't exist
        if (!file_exists($path)) {
            $filesystem->makeDirectory($path, 0755, true);
        }

        // Success message
        $this->info("Lesson created successfully!");
        $this->table(
            ['id', 'title', 'uri'],
            Lesson::all(['id', 'title', 'uri'])->toArray()
        );
    }
}
