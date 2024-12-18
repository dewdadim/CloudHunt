<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Lesson::firstOrCreate(
            ['uri' => 'test-lesson2'],
            [
                'id' => 0,
                'uri' => 'test-lesson2',
                'title' => 'Test Lesson 2',
                'description' => ''
            ]
        );

        
    }
}
