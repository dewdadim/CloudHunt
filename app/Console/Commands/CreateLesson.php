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
     * Update the LessonSeeder.php file in project
     *
     * @param  array  $lessonData The data of the lesson
     * @return void
     */
    protected function updateSeeder($lessonData)
    {
        $seederPath = database_path('seeders/LessonSeeder.php');
        $content = file_get_contents($seederPath);
        
        // Find the position where we want to insert the new lesson
        $insertPosition = strpos($content, 'public function run(): void');
        $insertPosition = strpos($content, '{', $insertPosition) + 1;
        
        // Prepare the new lesson code
        $newLesson = "\n        \\App\\Models\\Lesson::firstOrCreate(\n";
        $newLesson .= "            ['uri' => '" . addslashes($lessonData['uri']) . "'],\n";
        $newLesson .= "            [\n";
        $newLesson .= "                'uri' => '" . addslashes($lessonData['uri']) . "',\n";
        $newLesson .= "                'title' => '" . addslashes($lessonData['title']) . "',\n";
        $newLesson .= "                'description' => '" . addslashes($lessonData['description']) . "'\n";
        $newLesson .= "            ]\n";
        $newLesson .= "        );\n";
        
        // Insert the new lesson code after the opening brace of run() method
        $content = substr_replace($content, $newLesson, $insertPosition, 0);
        
        file_put_contents($seederPath, $content);
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filesystem = new Filesystem();

        $title = $this->ask('What is the title for this lesson?');
        $uri = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title); // Remove symbols from title
        $uri = Str::kebab($uri); // Transform title to kebabcase format

        $description = $this->ask('Description for this lesson', null);

        $path = $this->getPath($uri);

        $lessonData = [
            'uri' => $uri,
            'title' => $title,
            'description' => $description
        ];

        // Save into database
        Lesson::create($lessonData);

        // Create the directory if it doesn't exist
        if (!file_exists($path)) {
            $filesystem->makeDirectory($path, 0755, true);
        }

        // Update the seeder
        $this->updateSeeder($lessonData);

        // Success message
        $this->info("Lesson created successfully!");
        $this->table(
            ['id', 'title', 'uri'],
            Lesson::all(['id', 'title', 'uri'])->toArray()
        );
    }
}
