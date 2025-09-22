<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\CourseContent;

class CourseContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        
        foreach ($courses as $course) {
            // Create sample course content
            $contents = [
                [
                    'title' => 'مقدمة في الدورة',
                    'description' => 'نظرة عامة على الدورة وأهدافها',
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'duration' => 10,
                    'order' => 1,
                    'is_free' => true,
                ],
                [
                    'title' => 'الأساسيات',
                    'description' => 'تعلم الأساسيات والمفاهيم المهمة',
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'duration' => 25,
                    'order' => 2,
                    'is_free' => false,
                ],
                [
                    'title' => 'التطبيق العملي',
                    'description' => 'تطبيق ما تعلمته في مشاريع حقيقية',
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'duration' => 35,
                    'order' => 3,
                    'is_free' => false,
                ],
                [
                    'title' => 'الاختبار النهائي',
                    'description' => 'اختبار فهمك للمادة',
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'duration' => 15,
                    'order' => 4,
                    'is_free' => false,
                ],
            ];

            foreach ($contents as $contentData) {
                CourseContent::create([
                    'course_id' => $course->id,
                    'title' => $contentData['title'],
                    'description' => $contentData['description'],
                    'video_url' => $contentData['video_url'],
                    'duration' => $contentData['duration'],
                    'order' => $contentData['order'],
                    'is_free' => $contentData['is_free'],
                ]);
            }
        }
    }
}
