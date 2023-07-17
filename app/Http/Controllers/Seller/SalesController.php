<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;


class SalesController extends Controller
{
    public function index()
    {
        return view('frontend.seller.sales');
    }
}
