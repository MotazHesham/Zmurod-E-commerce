<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run()
    {
        $slider1 = Slider::create([
            'title' => 'Slider Title 1',
            'status' => '1',
            'description' => 'Description for slider 1...',
        ]);
        
        // Upload slider 1 image if file exists
        $imagePath1 = public_path('assets/images/slider-bg-2-1.jpg');
        if (file_exists($imagePath1)) {
            $tmpPath1 = storage_path('tmp/uploads/slider_1.jpg');
            if (!file_exists(storage_path('tmp/uploads'))) {
                mkdir(storage_path('tmp/uploads'), 0755, true);
            }
            copy($imagePath1, $tmpPath1);
            $slider1->addMedia($tmpPath1)->toMediaCollection('photo');
        }

        $slider2 = Slider::create([
            'title' => 'Slider Title 2',
            'status' => '1',
            'description' => 'Description for slider 2...',
        ]);

        // Upload slider 2 image if file exists
        $imagePath2 = public_path('assets/images/slider-bg-2-2.jpg');
        if (file_exists($imagePath2)) {
            $tmpPath2 = storage_path('tmp/uploads/slider_2.jpg');
            copy($imagePath2, $tmpPath2);
            $slider2->addMedia($tmpPath2)->toMediaCollection('photo');
        }
    }
}
