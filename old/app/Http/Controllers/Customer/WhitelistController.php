<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Whitelist;
use Illuminate\Http\Request;

class WhitelistController extends Controller
{

  public function store(Request $request)
  {
    // Get the authenticated user
    $customerId = auth()->user()->id; // Auth::id()
    // find product
    $productId = $request->input('product_id');
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
    // flag
    $exist = 0 ; 
    // Find or create the cart for the customer
    $whitelist = auth()->user()->whitelist()->where('product_id', $productId)->first();
    $exist = 0;
    if ($whitelist) {
        $exist = 1;
    } else {
        $whitelist = Whitelist::create([
          'name' => $product->name ,  
          'price'=> $product->price , 
          'product_id'=>$product->id, 
          'user_id' =>  $customerId
        ]);
        $exist = 0;
    }
    //return the <li> of product;
      if (isset($product->image)) {
        $image_first = isset($product->image[0]) ? $product->image[0]->getUrl() : asset('assets/images/blank.jpg');
    } else {
        $image_first = asset('assets/images/blank.jpg');
    }

    $str = '<li id="whitlist-item-{{$whitelist->id}}">
              <a href="" class="image"> <img src="' . $image_first . '" alt="Whitlist product Image"></a>
                <div class="content">
                    <a href="#" class="title ml-3"><h6>'.$whitelist->product->name.'</h6>  </a>
                    <span class="amount">'.$whitelist->product->price.'</span>
                    <a href="#" onclick="deleteFromWhitelist('.$whitelist->id.')" class="remove">×</a>
                </div>
            </li>' ;

    return response()->json(['html' => $str, 'whitlist_id' => $whitelist->id ,'exist'=>$exist]);
  }
  public function destroy(Request $request)
  {
    $whitelist = Whitelist::find($request->id);

    if(!$whitelist){
      return response()->json(['message' => 'Cart item not found'], 404);
    }

    $whitelist->delete();

    return response()->json(['message' => 'Item removed from Whitelist successfully']);
  }

  public function show() 
  {
    $whitelist = Whitelist::with('product')->get();
    return view('frontend.customer.whitelist' , compact('whitelist'));
  }
}
