<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function show()
    {

        // shipping cost
        $shipment = AboutUs::findOrfail(1);
        $normal = $shipment->normal_shipment_cost;
        $fast = $shipment->fast_shipment_cost;

        return view('frontend.cart');
    }

    public function cart_store_product(Request $request)
    {
        // find product
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // Get the authenticated user
        $customerId = auth()->user()->id; // Auth::id()

        // Find or create the cart for the customer
        $cart = auth()->user()->cart()->where('product_id', $productId)->first();
        $exist = 0;
        if ($cart) {
            $cart->quantity += 1;
            $cart->price += $product->price;
            $cart->total_cost = $cart->quantity * $cart->price_with_discount;
            $cart->save();
            $exist = 1;
        } else {
            $cart = Cart::create([
                'user_id' => $customerId,
                'product_id' => $productId,
                'price' => $product->price,
                'price_with_discount' => $product->price - ($product->price * ($product->discount / 100)),
                'quantity' => 1,
                'total_cost' =>  $product->price - ($product->price * ($product->discount / 100))
            ]);
            $exist = 0;
        }

        //return the <li> of product;
        if (isset($product->image)) {
            $image_first = isset($product->image[0]) ? $product->image[0]->getUrl() : asset('assets/images/blank.jpg');
        } else {
            $image_first = asset('assets/images/blank.jpg');
        }
        $str = '<li id="cart-item-' . $cart->id . '">
                    <a href="" class="image"><img src="' . $image_first . '" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="" class="title" style="font-size: 20px;">' . $product->name . '</a>
                        <div class="d-flex justify-content-around">
                            <span class="quantity" style="font-size: 25px;"> ' . $cart->quantity . '</span>
                            <span class="price" style="font-size: 20px;">' . $cart->price_with_discount . '</span>
                        </div>
                    </div>
                    <a  class="remove" href="#" onclick="remove_from_cart(' . $cart->id . ')">×</a>        
                </li>';
                
        // count of product in cart 
        $carts = Cart::all();
        $count = 0 ;
        foreach($carts as $cart)
        {
            $count += $cart->quantity;
        }
            
        return response()->json(['html' => $str, 'exist' => $exist, 'cart_id' => $cart->id, 'count' => $count]);
    }

    public function cart_remove_product(Request $request)
    {   
        $cart = Cart::find($request->id);
        // Check if the cart item exists
        if (!$cart) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        $cart->delete();

        // count of product in cart 
        $carts = Cart::all();
        $count = 0 ;
        foreach($carts as $cart)
        {
            $count += $cart->quantity;
        }
        return response()->json(['message' => 'Item removed from cart successfully' , 'count' =>$count]);
    }
}
