<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Create a sample user
        $user = User::create([
            'name' => 'Abanoub',
            'email' => 'customer@customer.com',
            'password' => Hash::make('123456'), 
            'user_type' => 'customer',
            'country' => 'Egypt', 
            'phone' => '1234567890', 
            'address' =>'11 dummy st cairo', 
        ]);

        // Create a customer associated with the user
        Customer::create([
            'user_id' => $user->id,
        ]);

    }
}
