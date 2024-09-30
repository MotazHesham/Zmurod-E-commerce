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
        $slider1->addMediaFromUrl(asset('assets/images/slider-bg-2-1.jpg'))->toMediaCollection('photo');

        $slider2 = Slider::create([
            'title' => 'Slider Title 2',
            'status' => '1',
            'description' => 'Description for slider 2...',
        ]);

        $slider2->addMediaFromUrl(asset('assets/images/slider-bg-2-2.jpg'))->toMediaCollection('photo');
    }
}
