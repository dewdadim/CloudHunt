<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Module;
use App\Models\Chapter;
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
     * @param  string  $course The title of the course
     * @param  string  $chapter The title of the chapter 
     * @param  string  $name The title of the module
     * @return string
     */
    private function getPath($course, $chapter, $name)
    {
        $name = class_basename(str_replace('\\', '/', $name));
        $course = Str::kebab($course);
        $chapter = Str::kebab($chapter);

        return "{$this->laravel['path']}/../resources/js/components/courses/{$course}/{$chapter}/{$name}.vue";
    }

    /**
     * Generate the {module}.vue file in project
     *
     * @param  string  $name The title of the module 
     * @param  string  $path The path directory of the module
     * @return string
     */
    private function generateModuleFile($title, $path)
    {
        $filesystem = new Filesystem();
        $stub = $filesystem->get($this->getStub());

        $name = preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$title); // Remove symbols from title
        $name = Str::kebab($name);

        // Replace placeholders in the stub
        $stub = str_replace('{{ title }}', $title, $stub);
        $stub = str_replace('{{ path }}', $path, $stub);

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
        
        // Prompt attributes to user
        $courses = Course::all();
        $course = $this->choice('What course this module belongs to?', array_column(json_decode($courses), 'title'));
        $courseId = Course::where('title', $course)->pluck('id')->first();

        $chapters = Chapter::where('course_id', $courseId)->get();
        $chapter = $this->choice('Which chapter this module belongs to?', array_column(json_decode($chapters), 'title'));
        $chapterId = Chapter::where('title', $chapter)->pluck('id')->first();

        $title = $this->ask('What is the title for this Module?');

        $uri = preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$title); // Remove symbols from title
        $uri = Str::kebab($uri);

        $path = $this->getPath($course, $chapter, $uri);
        
        $category = $this->choice('How difficult this module is?', ['Video', 'Activity', 'Quiz']);
        
        $difficulty = $this->choice('How difficult this module is?', ['Easy', 'Moderate', 'Hard']);

        // Save into database
        Module::create([
            'uri' => $uri,
            'title' => $title,
            'chapter_id' => $chapterId,
            'category' => $category,
            'difficulty' => $difficulty
        ]);

        $this->generateModuleFile($title, $path); // Generate .vue file

        // Success message
        $this->info("Vue component {$uri}.vue created successfully! Located at: {$path}");
        $this->info("Module '{$title}' for '{$chapter}' created successfully!");
        $this->table(
            ['id', 'title'],
            Module::select('id', 'title')->where('chapter_id', $chapterId)->get()
        );

    }
}
