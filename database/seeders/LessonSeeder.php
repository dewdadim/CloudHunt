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
            ['id' => 12],
            [
                'id' => 12,
                'uri' => 'fundamental-of-cloud-computing',
                'title' => 'Fundamental of Cloud Computing',
                'description' => ''
            ]
        );

        
    }
}
