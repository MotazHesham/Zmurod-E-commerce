<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
class SellerSeeder extends Seeder
{
    public function run()
    {
        // Create a sample user if not exists
        $user = User::updateOrCreate(
            ['email' => 'seller@seller.com'],
            [
                'name' => 'Abanoub',
                'password' => Hash::make('123456'), 
                'user_type' => 'seller',
                'country' =>'Egypt',
                'phone'=> '01270433409',
                'address' => '12 dummy st Cairo', 
            ]
        );

        // Create a seller associated with the user if not exists
        Seller::updateOrCreate(
            ['user_id' => $user->id],
            [
                'store_name' =>'Happines Store',
                'description' => 'bla bla bla bla',
                'featured_store' => false ,
                'user_id' => $user->id
            ]
        );

    }
}
