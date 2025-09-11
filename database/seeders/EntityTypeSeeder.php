<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EntityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entityTypes = [
            [
                'name' => 'فرد',
                'organization_name' => null,
            ],
            [
                'name' => 'منظمة',
                'organization_name' => null,
            ],
            [
                'name' => 'تابع لمنظمة',
                'organization_name' => null,
            ],
        ];

        foreach ($entityTypes as $entityTypeData) {
            EntityType::updateOrCreate(
                ['name' => $entityTypeData['name']],
                $entityTypeData
            );
        }
    }
}
