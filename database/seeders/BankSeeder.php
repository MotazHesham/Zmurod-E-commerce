<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run()
    {
        $banks = [
            [
                'name' => 'البنك الأهلي السعودي',
            ],
            [
                'name' => 'بنك الرياض',
            ],
            [
                'name' => 'بنك ساب',
            ],
            [
                'name' => 'البنك السعودي للاستثمار',
            ],
            [
                'name' => 'البنك العربي الوطني',
            ],
            [
                'name' => 'بنك البلاد',
            ],
            [
                'name' => 'البنك السعودي الفرنسي',
            ],
            [
                'name' => 'بنك الجزيرة',
            ],
            [
                'name' => 'بنك الإنماء',
            ],
            [
                'name' => 'البنك الأول',
            ],
        ];

        foreach ($banks as $bankData) {
            Bank::updateOrCreate(
                ['name' => $bankData['name']],
                $bankData
            );
        }
    }
}
