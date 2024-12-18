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
            ['id' => 18],
            [
                'id' => 18,
                'uri' => 'what-is-cloud',
                'title' => 'What is Cloud?',
                'description' => '',
                'lesson_id' => 12,
                'category' => 'Learn',
                'difficulty' => 'Easy'
            ]
        );

        
    }
}
