<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;
use App\Models\Exercise;
use Faker\Provider\Lorem;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // Courses list
        $courses = [
            [
                'title' => 'HTML',
                'description' => 'Cours de base sur le HTML. Dans ce cours vous allez apprendre pas à pas à maîtriser les fondamentaux de l\'HTML',
                'image_path' => 'path/to/html/image.jpg',
                'is_active' => true,
                'is_premium' => false
            ],
            [
                'title' => 'CSS',
                'description' => 'Cours de base sur le CSS. Dans ce cours vous allez apprendre pas à pas à maîtriser les fondamentaux du CSS',
                'image_path' => 'path/to/css/image.jpg',
                'is_active' => true,
                'is_premium' => false
            ],
            [
                'title' => 'JavaScript',
                'description' => 'Cours de base sur le JavaScript. Dans ce cours vous allez apprendre pas à pas à maîtriser les fondamentaux du JavaScript',
                'image_path' => 'path/to/javascript/image.jpg',
                'is_active' => true,
                'is_premium' => true
            ],
        ];

        // Create courses and exercises
        foreach ($courses as $courseData) {
            $courseData['slug'] = Str::slug($courseData['title']);
            $course = Course::create($courseData);

            for ($c = 1; $c <= 3; $c++) { // 3 chapters per course
                $chapter = Chapter::create([
                    'course_id' => $course->id,
                    'title' => "{$course->title} Chapitre $c",
                    'slug' => Str::slug("{$course->title} Chapitre $c"),
                    'description' => "Description du chapitre $c pour le cours de {$course->title}.",
                    'is_active' => true,
                    'is_premium' => false,
                ]);

                for ($l = 1; $l <= 3; $l++) { // 3 lessons per chapter
                    $lesson = Lesson::create([
                        'chapter_id' => $chapter->id,
                        'title' => "{$chapter->title} Leçon $l",
                        'slug' => Str::slug("{$chapter->title} Leçon $l"),
                        'description' => "Description de la leçon $l pour le chapitre $c du cours de {$course->title}.",
                        'is_active' => true,
                        'is_premium' => false,
                    ]);

                    for ($e = 1; $e <= 5; $e++) { // 5 exercises per lesson
                        Exercise::create([
                            'lesson_id' => $lesson->id,
                            'title' => "Exercice $e de la leçon $lesson->title",
                            'directive' => "Énoncé de l'exercice $e pour la leçon $l du chapitre $c du cours de {$course->title}.",
                            'initial_code' => "<h1>Lorem $e</h1>
                            <p>Lorem ipsum $e</p>",
                            'expected_code' => "<h1>Lorem $e</h1>
                            <p>Lorem ipsum $e</p>",
                            'is_active' => true,
                            'is_premium' => false,
                        ]);
                    }
                }
            }
        }
    }
}
