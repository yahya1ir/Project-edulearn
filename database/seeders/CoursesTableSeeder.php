<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            [
                'title'  => 'HTML & CSS Mastery',
                'idea'   => 'Build beautiful websites',
                'topics' => json_encode(['Flexbox & Grid', 'Responsive Design', 'Animations', 'UI Design Basics']),
                'price'  => '$29',
                'color'  => 'rgba(59,130,246,0.15)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'  => 'React JS Complete Guide',
                'idea'   => 'Build dynamic frontends',
                'topics' => json_encode(['Components', 'Hooks', 'State Management', 'API Integration']),
                'price'  => '$59',
                'color'  => 'rgba(6,182,212,0.15)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'  => 'PHP & MySQL Fundamentals',
                'idea'   => 'Backend basics',
                'topics' => json_encode(['PHP Syntax', 'Forms Handling', 'MySQL Queries', 'CRUD Operations']),
                'price'  => '$35',
                'color'  => 'rgba(139,60,247,0.2)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'  => 'Cybersecurity Basics',
                'idea'   => 'Introduction to security',
                'topics' => json_encode(['Types of attacks', 'Password security', 'Network basics', 'Ethical hacking intro']),
                'price'  => '$45',
                'color'  => 'rgba(16,185,129,0.15)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'  => 'Git & GitHub for Developers',
                'idea'   => 'Version control mastery',
                'topics' => json_encode(['Git commands', 'Branching', 'Merging', 'GitHub workflow']),
                'price'  => '$19',
                'color'  => 'rgba(249,115,22,0.15)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'  => 'UI/UX Design Fundamentals',
                'idea'   => 'Design better user experiences',
                'topics' => json_encode(['Design principles', 'Wireframing', 'Prototyping', 'User psychology']),
                'price'  => '$25',
                'color'  => 'rgba(232,121,249,0.15)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'  => 'Python for Beginners',
                'idea'   => 'Learn programming with Python',
                'topics' => json_encode(['Variables & loops', 'Functions', 'File handling', 'Intro to automation']),
                'price'  => '$30',
                'color'  => 'rgba(234,179,8,0.15)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'  => 'Data Structures & Algorithms',
                'idea'   => 'Improve problem-solving skills',
                'topics' => json_encode(['Arrays & Linked Lists', 'Stacks & Queues', 'Sorting Algorithms', 'Complexity (Big-O)']),
                'price'  => '$55',
                'color'  => 'rgba(99,102,241,0.2)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('courses')->insert($courses);
    }
}
