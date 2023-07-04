<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id) {
        $product = Product::findOrFail($id) ;
        $related_products = Product::with('media','product_category')->where('product_category_id',$product->product_category_id)->get()->take(8);
        return view('frontend.product' , compact('product','related_products'));
    }

    public function show_popup($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.productpopup'  ,compact('product'));
    }

}
