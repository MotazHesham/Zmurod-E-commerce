<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'اقمشه', 'icon_path' => public_path('assets/images/icons/1.png')],
            ['name' => 'اخشاب', 'icon_path' => public_path('assets/images/icons/2.png')],
            ['name' => 'مكرميات', 'icon_path' => public_path('assets/images/icons/3.png')],
            ['name' => 'فنون', 'icon_path' => public_path('assets/images/icons/4.png')],
            ['name' => 'اكسسوارات', 'icon_path' => public_path('assets/images/icons/5.png')],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'most_recent' => true,
                'fav' => true,
            ]);
        
            // Upload the icon for the category if file exists
            if (file_exists($categoryData['icon_path'])) {
                // Copy file to tmp directory first
                $tmpPath = storage_path('tmp/uploads/' . basename($categoryData['icon_path']));
                if (!file_exists(storage_path('tmp/uploads'))) {
                    mkdir(storage_path('tmp/uploads'), 0755, true);
                }
                copy($categoryData['icon_path'], $tmpPath);
                
                $category->addMedia($tmpPath)
                    ->toMediaCollection('icon');
            }
        }
    }
}
