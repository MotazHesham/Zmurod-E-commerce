<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    function index() {
        $sellers = Seller::with('media')->get();
        return view('frontend.shops',compact('sellers'));
    }

    function shop($id) {
        $seller = Seller::find($id);
        // get the product's related to this seller
        $products = Product::with('user','product_offers','media')->where('user_id',$seller->user_id)->get()->take(4);
        // return $products;
        return view('frontend.singleshop',compact('seller','products'));
    }

    function show() {
        $products= Product::all();
        return view('frontend.marketshop',compact('products'));
    }
}
