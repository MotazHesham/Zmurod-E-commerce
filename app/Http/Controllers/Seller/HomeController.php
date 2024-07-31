<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    function index()
    {

        $totalSoldProducts = 0 ; 
        $totalSoldOrders = 0 ; 
        $totalProducts = 0 ; 

        // orders
        $orders = Order::with('orderProduct.product')->where('delivery_status','delivered')->whereHas('orderProduct.product',function($query){
            return $query->where('user_id',auth()->user()->id);
        });

        // total  sold products in order
        $order_products = OrderProduct::with('product','order.user')->whereHas('product',function($query){
            return $query->where('user_id',auth()->user()->id);
        })->get();

        $totalSoldProducts = $order_products->sum('quantity');
        $totalSoldOrders = $orders->count();
        $totalProducts = Product::where('user_id',auth()->user()->id)->count();
        return view('frontend.seller.dashboard' ,compact('totalSoldProducts' ,'totalSoldOrders' , 'totalProducts', 'order_products'));
    }

    public function updateProfile(Request $request){

        $user = Auth::user();
        $user->update($request->all());
        return redirect()->route('seller.profile');
    }
}
