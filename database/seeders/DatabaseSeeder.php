<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'title'  => 'Laravel for Beginners',
                'idea'   => 'Learn Laravel from scratch',
                'topics' => json_encode(['MVC Architecture', 'Routing & Controllers', 'Blade Templates', 'Authentication']),
                'price'  => '$49',
                'color'  => 'rgba(239,68,68,0.15)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'  => 'Advanced JavaScript',
                'idea'   => 'Master modern JS',
                'topics' => json_encode(['Closures', 'Promises & Async/Await', 'ES6+ Features', 'APIs & Fetch']),
                'price'  => '$39',
                'color'  => 'rgba(245,158,11,0.15)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... add the rest of your courses here ...
        ];

        DB::table('courses')->insert($courses);
    }
}