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
            ['id' => '9ddac052-83ec-4ce4-aa16-86a30dba9ece'],
            [
                'id' => '9ddac052-83ec-4ce4-aa16-86a30dba9ece',
                'uri' => 'linux-terminal-for-beginners',
                'title' => 'Linux Terminal for Beginners',
                'description' => 'Equip yourself with the foundational knowledge and skills to navigate and use the Linux terminal effectively.'
            ]
        );

        \App\Models\Lesson::firstOrCreate(
            ['id' => '9dc4d34c-d514-410a-b372-951ba9158df2'],
            [
                'id' => '9dc4d34c-d514-410a-b372-951ba9158df2',
                'uri' => 'test-lesson',
                'title' => 'Test Lesson',
                'description' => ''
            ]
        );

        \App\Models\Lesson::firstOrCreate(
            ['id' => '9dc0cdf3-abd6-4113-8361-3a72b5bcd327'],
            [
                'id' => '9dc0cdf3-abd6-4113-8361-3a72b5bcd327',
                'uri' => 'fundamentals-of-cloud-computing',
                'title' => 'Fundamentals of Cloud Computing',
                'description' => ''
            ]
        );

        
    }
}
