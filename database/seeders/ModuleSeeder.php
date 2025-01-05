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
            ['id' => '9ddac21b-b089-4040-8f8c-ad4ca7a00e7e'],
            [
                'id' => '9ddac21b-b089-4040-8f8c-ad4ca7a00e7e',
                'uri' => 'introduction-to-the-linux-terminal',
                'title' => 'Introduction to the Linux Terminal',
                'description' => 'Understand what the Linux terminal is, its history, and why it\'s important.',
                'lesson_id' => '9ddac052-83ec-4ce4-aa16-86a30dba9ece',
                'category' => 'Learn',
                'difficulty' => 'Easy'
            ]
        );

        \App\Models\Module::firstOrCreate(
            ['id' => '9dcc66cf-d71f-4710-806a-0e5623b081fc'],
            [
                'id' => '9dcc66cf-d71f-4710-806a-0e5623b081fc',
                'uri' => 'test-module2',
                'title' => 'Test Module 2',
                'description' => '',
                'lesson_id' => '9dc4d34c-d514-410a-b372-951ba9158df2',
                'category' => 'Test',
                'difficulty' => 'Hard'
            ]
        );

        \App\Models\Module::firstOrCreate(
            ['id' => '9dc4ccc7-00dd-42e1-89d5-8469bc771ebd'],
            [
                'id' => '9dc4ccc7-00dd-42e1-89d5-8469bc771ebd',
                'uri' => 'test-module',
                'title' => 'Test Module',
                'description' => '',
                'lesson_id' => '9dc4d34c-d514-410a-b372-951ba9158df2',
                'category' => 'Learn',
                'difficulty' => 'Easy'
            ]
        );

        \App\Models\Module::firstOrCreate(
            ['id' => '9dc4ccc7-00dd-42e1-89d5-8469bc771ebd'],
            [
                'id' => '9dc4ccc7-00dd-42e1-89d5-8469bc771ebd',
                'uri' => 'test-module',
                'title' => 'Test Module',
                'description' => 'This is for test',
                'lesson_id' => '9dc0cdf3-abd6-4113-8361-3a72b5bcd327',
                'category' => 'Test',
                'difficulty' => 'Easy'
            ]
        );

        \App\Models\Module::firstOrCreate(
            ['id' => '9dc0d27c-3f79-441d-a65d-b2eec53e6e2d'],
            [
                'id' => '9dc0d27c-3f79-441d-a65d-b2eec53e6e2d',
                'uri' => 'cloud-services-category',
                'title' => 'Cloud Services Category',
                'description' => '0',
                'lesson_id' => '9dc0cdf3-abd6-4113-8361-3a72b5bcd327',
                'category' => 'Learn',
                'difficulty' => 'Easy'
            ]
        );

        \App\Models\Module::firstOrCreate(
            ['id' => '9dc0ce06-58d4-496e-8953-73ad406fed9d'],
            [
                'id' => '9dc0ce06-58d4-496e-8953-73ad406fed9d',
                'uri' => 'what-is-cloud',
                'title' => 'What is Cloud?',
                'description' => '',
                'lesson_id' => '9dc0cdf3-abd6-4113-8361-3a72b5bcd327',
                'category' => 'Learn',
                'difficulty' => 'Easy'
            ]
        );

        
    }
}
