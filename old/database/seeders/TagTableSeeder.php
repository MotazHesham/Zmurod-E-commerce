<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;


class TagTableSeeder extends Seeder
{
    public function run()
    {
        $tagsData = [
            ['name' => 'ممتاز'],
            ['name' => 'متوسط'],
            ['name' => 'رائع'],
            ['name' => 'محتوى قيم'],
        ];

        foreach ($tagsData as $tag) {
            Tag::create($tag);
        }
    }
}
