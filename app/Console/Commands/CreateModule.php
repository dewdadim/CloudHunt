<?php

namespace App\Console\Commands;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a learn module for chapter';

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
    protected function getStub()
    {
        return __DIR__ . '/../Stubs/module.stub';
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        $name = class_basename(str_replace('\\', '/', $rawName));

        $path = "{$this->laravel['path']}/../resources/js/components/modules/{$name}.vue";

        return file_exists($path);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $name = class_basename(str_replace('\\', '/', $name));

        $stub = str_replace('{Component}', $name, $stub);

        return $this;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = class_basename(str_replace('\\', '/', $name));

        return "{$this->laravel['path']}/../resources/js/components/modules/{$name}.vue";
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $name = $this->argument('name');
        $chapter = Chapter::where('course_id', )->count();
        $filesystem = new Filesystem();

        // Define the path for the Vue component
        $path = $this->getPath($name);

        // Create the directory if it doesn't exist
        if (!$filesystem->isDirectory(dirname($path))) {
            $filesystem->makeDirectory(dirname($path), 0755, true);
        }

        // Check if the Module already exist
        if($this->alreadyExists($name)){
            $this->error("Module {$name} already exist!");
            return 1;
        }

        // Load the stub template
        $stub = $filesystem->get($this->getStub());

        // Replace placeholders in the stub
        $stub = str_replace('{{ componentName }}', $name, $stub);


        // Prompt attributes to user

        $courses = Course::all();

        $courseTitle = $this->choice('What course this module belongs to?', array_column(json_decode($courses), 'title'));

        $chapters = Chapter::where('id', $courseTitle);

        print_r(json_decode($chapters));

        $chapterId = $this->choice('Which chapter this module belongs to?', ['ss']);

        $title = $this->ask('What is the title for the Module?');

        $difficulty = $this->choice('How difficult this module is?', ['Easy', 'Moderate', 'Difficult']);

        // Write the Vue file
        $filesystem->put($path, $stub);

        $this->info("Vue component {$name}.vue created successfully!");

    }
}
