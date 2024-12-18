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
        return resource_path('/js/components/lessons/' . Str::kebab(class_basename($name)));
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
        
        // Find position after run() method opening brace
        $insertPosition = strpos($content, 'public function run(): void');
        $insertPosition = strpos($content, '{', $insertPosition) + 1;
        
        // Get the lesson's ID from the database
        $lessonId = Lesson::where('uri', $lessonData['uri'])->first()->id;
        
        // Prepare the new lesson code
        $newLesson = "\n        \\App\\Models\\Lesson::firstOrCreate(\n" .
            "            ['id' => " . $lessonId . "],\n" .
            "            [\n" .
            "                'id' => " . $lessonId . ",\n" .
            "                'uri' => '" . addslashes($lessonData['uri']) . "',\n" .
            "                'title' => '" . addslashes($lessonData['title']) . "',\n" .
            "                'description' => '" . addslashes($lessonData['description']) . "'\n" .
            "            ]\n" .
            "        );\n";
        
        file_put_contents($seederPath, substr_replace($content, $newLesson, $insertPosition, 0));
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $title = $this->ask('What is the title for this lesson?');
        $uri = Str::kebab(preg_replace('/[^\p{L}\p{N}\s]/u', '', $title));
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
        $filesystem = new Filesystem();
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
