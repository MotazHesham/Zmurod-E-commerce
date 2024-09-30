<?php

namespace Database\Seeders;

use App\Models\Froum;
use Illuminate\Database\Seeder;

class FroumsTableSeeder extends Seeder
{
    public function run()
    {
        $forumsData = [
            [
                'name' => 'فوائد الاعمال اليدوية ',
            ],


            [
                'name' => 'موضوعات اخرى',
            ],
        ];

        foreach ($forumsData as $forum) {
            Froum::create($forum);
        }
    }
}
