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
     * Get the stub file for the generator.
     *
     * @return string
     */
    private function getStub()
    {
        return __DIR__ . '/../Stubs/module.stub';
    }

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

        return "{$this->laravel['path']}/../resources/js/components/lessons/{$lesson}/{$name}.vue";
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
        $stub = $filesystem->get($this->getStub());

        $name = preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$title); // Remove symbols from title
        $name = Str::kebab($name);

        // Replace placeholders in the stub
        $stub = str_replace('{{ title }}', $title, $stub);
        $stub = str_replace('{{ path }}', $path, $stub);
        $stub = str_replace('{{ lesson }}', $lessonTitle, $stub);


        // Create the directory if it doesn't exist
        if (!$filesystem->isDirectory(dirname($path))) {
            $filesystem->makeDirectory(dirname($path), 0755, true);
        }

        // Check if the Module already exist
        if(file_exists($path)){
            $this->error("Module {$name} already exist!");
            return 1;
        }

        // Write the Vue file
        return $filesystem->put($path, $stub);
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

        $path = $this->getPath($lesson, $uri);
        
        $category = $this->choice('How difficult this module is?', ['Learn', 'Test']);
        
        $difficulty = $this->choice('How difficult this module is?', ['Easy', 'Moderate', 'Hard']);

        // Save into database
        Module::create([
            'uri' => $uri,
            'title' => $title,
            'description' => $description,
            'lesson_id' => $lessonId,
            'category' => $category,
            'difficulty' => $difficulty
        ]);

        $this->generateModuleFile($lesson, $title, $path); // Generate .vue file

        // Success message
        $this->info("Vue component {$uri}.vue created successfully! Located at: {$path}");
        $this->info("Module '{$title}' for '{$lesson}' created successfully!");
        $this->table(
            ['id', 'title'],
            Module::select('id', 'title', 'description')->where('lesson_id', $lessonId)->get()
        );

    }
}
