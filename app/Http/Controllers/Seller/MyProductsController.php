<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyProductsController extends Controller
{
    public function index()
    {
        return view('frontend.seller.products');
    }

    public function show()
    {
        return view('frontend.seller.addproduct');
    }
}
