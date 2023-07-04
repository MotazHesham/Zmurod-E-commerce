<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    function index() {
        return view('frontend.register');
    }

    public function register_customer(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        // store in DB
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
            'user_type' => 'customer',
        ]);

        // login the user and redirect
        Auth::login($user);
        return redirect()->route('customer.home');
    }

    public function register_seller(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Create a new seller user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
            'user_type' => 'seller',
        ]);

        // Login the user and redirect
        Auth::login($user);
        return redirect()->route('seller.home');
    }
}
