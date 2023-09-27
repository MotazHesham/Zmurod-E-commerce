<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    function index() {
        $sellers = Seller::with('media')->where('featured_store',1)->get();
        return view('frontend.shops',compact('sellers'));
    }

    function shop($id) {
        $seller = Seller::find($id);
        // get the product's related to this seller
        $products = Product::with('user','product_offers','media')->where('user_id',$seller->user_id)->take(8)->get();
        // return $products;
        return view('frontend.singleshop',compact('seller','products'));
    }

    function show(Request $request) {
        
        $category = $sort_by = $search = null;

        $products= Product::with('user','product_offers','media');

        if($request->category != null){
            $category = $request->category;
            $products = $products->where("product_category_id",$request->category);
        }
        if($request->search != null){ 
            $search = $request->search;
            $products = $products->where('name','like','%' . $search . '%');  
        }
        if($request->sort_by != null){
            $sort_by = $request->sort_by;
            switch ($sort_by) { 
                case 'price_low':
                    $products->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $products->orderBy('price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }
        $products = $products->paginate(15);
        return view('frontend.marketshop',compact('products','category','sort_by','search'));
    }
}
