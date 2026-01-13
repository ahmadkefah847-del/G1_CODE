<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Efficient Irrigation Tips',
                'body' => 'Use drip systems to reduce water waste and improve yield.',
                'type' => 'tips',
                'locale' => 'en',
                'image_path' => 'images/drip.jpg',
                'published' => true,
            ],
            [
                'title' => 'Smart Leak Detection',
                'body' => 'Regularly inspect lines and valves to prevent leaks.',
                'type' => 'tips',
                'locale' => 'en',
                'image_path' => 'images/leak.jpg',
                'published' => true,
            ],
            [
                'title' => 'Understanding Irrigation Stats',
                'body' => 'Monitor system statistics to optimize water usage.',
                'type' => 'infographic',
                'locale' => 'en',
                'image_path' => 'images/stats.png',
                'published' => true,
            ],
            [
                'title' => 'نصائح ري فعّالة',
                'body' => 'استخدم الري بالتنقيط لتقليل الهدر وزيادة الإنتاج.',
                'type' => 'tips',
                'locale' => 'ar',
                'image_path' => 'images/drip.jpg',
                'published' => true,
            ],
            [
                'title' => 'كشف التسرب الذكي',
                'body' => 'افحص الأنابيب والصمامات بشكل دوري لمنع التسرب.',
                'type' => 'tips',
                'locale' => 'ar',
                'image_path' => 'images/leak.jpg',
                'published' => true,
            ],
            [
                'title' => 'فهم إحصائيات الري',
                'body' => 'راقب مؤشرات النظام لتحسين استهلاك المياه.',
                'type' => 'infographic',
                'locale' => 'ar',
                'image_path' => 'images/stats.png',
                'published' => true,
            ],
        ];

        foreach ($items as $data) {
            Content::firstOrCreate(
                ['title' => $data['title'], 'locale' => $data['locale']],
                $data
            );
        }
    }
}
