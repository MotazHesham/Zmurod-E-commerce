<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class MyProductsController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id',Auth::user()->id)->get();
       
        return view('frontend.seller.products', compact('products'));
    }

    public function create()
    {
        $product_categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('frontend.seller.addproduct',compact('product_categories'));
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        $products = Product::where('user_id',Auth::user()->id)->get();
        foreach ($request->input('image', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }
        return view('frontend.seller.products', compact('products'));
    }


}
