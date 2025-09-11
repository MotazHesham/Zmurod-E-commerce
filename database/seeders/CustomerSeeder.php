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
        // Create a sample user if not exists
        $user = User::updateOrCreate(
            ['email' => 'customer@customer.com'],
            [
                'name' => 'Abanoub',
                'password' => Hash::make('123456'), 
                'user_type' => 'customer',
                'country' => 'Egypt', 
                'phone' => '1234567890', 
                'address' =>'11 dummy st cairo', 
            ]
        );

        // Create a customer associated with the user if not exists
        Customer::updateOrCreate(
            ['user_id' => $user->id],
            ['user_id' => $user->id]
        );

    }
}
