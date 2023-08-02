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
            'user_type' => 'customer'
        ]);

        // Create a customer associated with the user
        Customer::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password, 
            'country' => 'EGYPT', 
            'phone' => '1234567890', 
            'user_id' => $user->id,
        ]);

    }
}
