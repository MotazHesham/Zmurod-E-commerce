<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        // Total sold Orders
        $orders = Order::with('orderProduct')->where('delivery_status','delivered')->get();
        $totalSoldProducts = 0 ; 
        foreach($orders as $order)
        {
            $totalSoldProducts +=$order->orderProduct->count() ; 
        }
        // total orders
        $totalOrders = Order::get()->count();

        // total products 
        $order_products = OrderProduct::with('product','order.user')->whereHas('product',function($query){
            return $query->where('user_id',auth()->user()->id);
        })->get();
        return view('frontend.seller.dashboard' ,compact('totalSoldProducts' ,'totalOrders' , 'order_products'));
    }
}
