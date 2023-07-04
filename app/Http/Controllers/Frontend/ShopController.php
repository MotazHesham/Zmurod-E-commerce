<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    function index() {
        $brands = Brand::all();
        return view('frontend.shops',compact('brands'));
    }

    function shop($id) {
        $brand = Brand::find($id);
        $products= Product::with('media')->where('brand_id',$id)->take(4)->get();

        return view('frontend.singleshop',compact('brand','products'));
    }

    function show() {
        $products= Product::all();

        return view('frontend.marketshop',compact('products'));
    }
}
