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
        // Create a sample user
        $user = User::create([
            'name' => 'Abanoub',
            'email' => 'seller@seller.com',
            'password' => Hash::make('123456'), 
            'user_type' => 'seller',
            'country' =>'Egypt',
            'phone'=> '01270433409',
            'address' => '12 dummy st Cairo', 
        ]);

        // Create a customer associated with the user
        Seller::create([
            'store_name' =>'Happines Store',
            'description' => 'bla bla bla bla',
            'featured_store' => false ,
            'user_id' => $user->id
        ]);

    }
}
