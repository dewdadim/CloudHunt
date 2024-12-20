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
