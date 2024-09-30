<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    public function run()
    {
        AboutUs::create([
            'vision' => 'Our vision variable',
            'email' => 'ourEmail@example.com',
            'phone_number' => '1234567890',
            'phone_number_2' => '9876543210',
            'normal_shipment_cost' => 50,
            'fast_shipment_cost' => 100,
            'name' => 'Hrayer',
        ]);
    }
}
