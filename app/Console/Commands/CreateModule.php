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

        // $name = $this->argument('name');
        $filesystem = new Filesystem();
        $stub = $filesystem->get($this->getStub());

        // Prompt attributes to user
        $courses = Course::all();
        $course = $this->choice('What course this module belongs to?', array_column(json_decode($courses), 'title'));
        $courseId = Course::where('title', $course)->pluck('id')->first();

        $chapters = Chapter::where('course_id', $courseId)->get();
        $chapter = $this->choice('Which chapter this module belongs to?', array_column(json_decode($chapters), 'title'));
        $chapterId = Chapter::where('title', $chapter)->pluck('id')->first();

        $title = $this->ask('What is the title for this Module?');

        $name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $title); // Remove symbols from title
        $name = Str::kebab($title);

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

        // Replace placeholders in the stub
        $stub = str_replace('{{ componentName }}', $title, $stub);

        // $difficulty = $this->choice('How difficult this module is?', ['Easy', 'Moderate', 'Difficult']);

        // Save into database
        Module::create([
            'title' => $title,
            'chapter_id' => $chapterId
        ]);

        // Write the Vue file
        $filesystem->put($path, $stub);

        // Success message
        $this->info("Vue component {$name}.vue created successfully! Located at: ../resources/js/components/modules/{$name}.vue");
        $this->info("Module '{$name}' for '{$chapter}' created successfully!");
        $this->table(
            ['id', 'title'],
            Module::select('id', 'title')->where('chapter_id', $chapterId)->get()
        );

    }
}
