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
                'name' => 'General Topics',
                'description' => 'This forum is for discussing general topics.',
                'category' => 'الموضوعات العامة',
            ],
            [
                'name' => 'Other Topics',
                'description' => 'This forum is for discussing other topics.',
                'category' => 'موضوعات اخرى',
            ],
        ];

        foreach ($forumsData as $forum) {
            Froum::create($forum);
        }
    }
}
