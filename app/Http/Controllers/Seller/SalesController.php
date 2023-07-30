<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;

class SalesController extends Controller
{
    public function index()
    {
        $order_products = OrderProduct::with('product','order.user')->whereHas('product',function($query){
            return $query->where('user_id',auth()->user()->id);
        })->get();
        return view('frontend.seller.sales' , compact('order_products'));
    }
}
