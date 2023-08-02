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
            'user_type' => 'seller'
        ]);

        // Create a customer associated with the user
        Seller::create([
            'name' =>$user->name,
            'email' =>$user->email,
            'password' =>$user->password,
            'country' =>'Egypt',
            'phone'=> '01270433409',
            'store_name' =>'Happines Store',
            'description' => 'bla bla bla bla',
            'featured_store' => false ,
            'user_id' => $user->id
        ]);

    }
}
