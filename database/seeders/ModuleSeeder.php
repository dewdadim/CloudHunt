<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Module::firstOrCreate(
            ['uri' => 'test-module2-for-lesson2'],
            [
                'uri' => 'test-module2-for-lesson2',
                'title' => 'Test Module 2 for Lesson 2',
                'description' => '',
                'lesson_id' => 11,
                'category' => 'Learn',
                'difficulty' => 'Easy'
            ]
        );

        \App\Models\Module::firstOrCreate(
            ['uri' => 'test-module1-for-lesson2'],
            [
                'uri' => 'test-module1-for-lesson2',
                'title' => 'Test Module 1 for Lesson 2',
                'description' => '',
                'lesson_id' => 11,
                'category' => 'Learn',
                'difficulty' => 'Easy'
            ]
        );

        
    }
}
