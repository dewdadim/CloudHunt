<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Lesson::factory()->create([
            'uri' => 'fundamentals-of-cloud-computing',
            'title' => 'Fundamentals of Cloud Computing',
            'description' => null,
        ]);

        Module::factory()->create([
            'uri' => 'what-is-cloud',
            'title' => 'What is Cloud?',
            'description' => null,
            'lesson_id' => 1,
            'category' => 'learn',
            'difficulty' => 'easy'
        ]);
    }
}
