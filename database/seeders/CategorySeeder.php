<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'اقمشه',
            'اخشاب',
            'مكرميات',
            'فنون',
            'اكسسوارات',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'most_recent' => true, 
                'fav' => true, 
            ]);
        }
    }
}
