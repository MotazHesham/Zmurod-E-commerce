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
                'description' => 'This forum is for discussing general topics.',
                'category' => 'الموضوعات العامة',
            ],
            [
                'name' => 'اشهر مشاريع الهاند ميد',
                'description' => 'This forum is for discussing other topics.',
                'category' => 'موضوعات اخرى',
            ],
            [
                'name' => 'الكروشية والتريكو ',
                'description' => 'This forum is for discussing other topics.',
                'category' => 'موضوعات اخرى',
            ],
            [
                'name' => 'الإبداع يبدا بفكرة',
                'description' => 'This forum is for discussing other topics.',
                'category' => 'موضوعات اخرى',
            ],
        ];

        foreach ($forumsData as $forum) {
            Froum::create($forum);
        }
    }
}
