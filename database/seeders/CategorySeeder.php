<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'اقمشه', 'icon_url' => 'assets/images/icons/1.png'],
            ['name' => 'اخشاب', 'icon_url' => 'assets/images/icons/2.png'],
            ['name' => 'مكرميات', 'icon_url' => 'assets/images/icons/3.png'],
            ['name' => 'فنون', 'icon_url' => 'assets/images/icons/4.png'],
            ['name' => 'اكسسوارات', 'icon_url' => 'assets/images/icons/5.png'],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'most_recent' => true,
                'fav' => true,
            ]);
        
            // Upload the icon for the category
            $category->addMediaFromUrl("http://local.zumord:8080/public/{$categoryData['icon_url']}")
                ->toMediaCollection('icon');
        }
    }
}
