<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class PopupModalController extends Controller
{
    public function show(Request $request)
    {
        $pId = $request->product_id;
        $product = Product::findOrFail($pId);
        return view('partials.quickview', compact('product'));
    }
}
