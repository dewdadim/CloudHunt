<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a learn module';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Vue template';

    /**
     * Get the destination class path.
     *
     * @param  string  $lesson The title of the lesson
     * @param  string  $name The title of the module
     * @return string
     */
    private function getPath($lesson, $name)
    {
        $name = class_basename(str_replace('\\', '/', $name));
        $lesson = Str::kebab($lesson);

        return "{$this->laravel['path']}/../resources/js/components/lessons/{$lesson}/{$name}";
    }

    /**
     * Generate the {module}.vue file in project
     *
     * @param  string  $name The title of the module 
     * @param  string  $path The path directory of the module
     * @return string
     */
    private function generateModuleFile($lessonTitle, $title, $path)
    {
        $filesystem = new Filesystem();
        
        if (!$filesystem->isDirectory($path)) {
            $filesystem->makeDirectory($path, 0755, true);
        }

        // Generate index.vue
        $indexStub = $filesystem->get(__DIR__ . '/../Stubs/Module.stub');
        $indexStub = str_replace(
            ['{{ title }}', '{{ path }}', '{{ lesson }}'],
            [$title, $path, $lessonTitle],
            $indexStub
        );
        $filesystem->put($path . '/index.vue', $indexStub);

        // Generate TaskExample.vue in the tasks directory
        $taskStub = $filesystem->get(__DIR__ . '/../Stubs/Task.stub');
        $filesystem->put($path . '/TaskExample.vue', $taskStub);

        return true;
    }

    /**
     * Update the ModuleSeeder.php file in project
     *
     * @param  array  $moduleData The data of the module
     * @return void
     */
    protected function updateSeeder($moduleData)
    {
        $seederPath = database_path('seeders/ModuleSeeder.php');
        $content = file_get_contents($seederPath);
        
        // Find the position where we want to insert the new module
        $insertPosition = strpos($content, 'public function run(): void');
        $insertPosition = strpos($content, '{', $insertPosition) + 1;
        
        // Get the module's ID from the database
        $moduleId = Module::where('uri', $moduleData['uri'])->first()->id;
        
        // Prepare the new module code
        $newModule = "\n        \\App\\Models\\Module::firstOrCreate(\n" .
            "            ['id' => '" . addslashes($moduleId) . "'],\n" .
            "            [\n" .
            "                'id' => '" . addslashes($moduleId) . "',\n" .
            "                'uri' => '" . addslashes($moduleData['uri']) . "',\n" .
            "                'title' => '" . addslashes($moduleData['title']) . "',\n" .
            "                'description' => '" . addslashes($moduleData['description']) . "',\n" .
            "                'lesson_id' => '" . addslashes($moduleData['lesson_id']) . "',\n" .
            "                'category' => '" . addslashes($moduleData['category']) . "',\n" .
            "                'difficulty' => '" . addslashes($moduleData['difficulty']) . "'\n" .
            "            ]\n" .
            "        );\n";
        
        file_put_contents($seederPath, substr_replace($content, $newModule, $insertPosition, 0));
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lessons = Lesson::all();
        $lesson = $this->choice('Which lesson this module belongs to?', array_column(json_decode($lessons), 'title'));
        $lessonId = Lesson::where('title', $lesson)->pluck('id')->first();

        $title = $this->ask('What is the title for this module?');
        $description = $this->ask('Description for this module', null);

        $uri = preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$title); // Remove symbols from title
        $uri = Str::kebab($uri);

        $category = $this->choice('How difficult this module is?', ['Learn', 'Test']);
        $difficulty = $this->choice('How difficult this module is?', ['Easy', 'Moderate', 'Hard']);

        $path = $this->getPath($lesson, $uri);

        // Collect all data in one array
        $moduleData = [
            'uri' => $uri,
            'title' => $title,
            'description' => $description,
            'lesson_id' => $lessonId,
            'category' => $category,
            'difficulty' => $difficulty,
            'lesson_title' => $lesson,
            'path' => $path
        ];

        // Save into database
        Module::create($moduleData);

        // Generate .vue file
        $this->generateModuleFile($moduleData['lesson_title'], $moduleData['title'], $moduleData['path']); 

        // Update the seeder
        $this->updateSeeder($moduleData);

        // Success message
        $this->info("Vue component {$moduleData['uri']}.vue created successfully! Located at: {$moduleData['path']}");
        $this->info("Module '{$moduleData['title']}' for '{$moduleData['lesson_title']}' created successfully!");
        $this->table(
            ['id', 'title', 'uri', 'lesson_id', 'category', 'difficulty'],
            Module::select('id', 'title', 'uri', 'lesson_id', 'category', 'difficulty')
                ->where('lesson_id', $moduleData['lesson_id'])
                ->get()
        );
    }
}
