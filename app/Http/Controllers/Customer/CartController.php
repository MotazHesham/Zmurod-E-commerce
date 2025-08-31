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

        // Check if product has enough stock
        $requestedQuantity = $request->input('quantity', 1);
        if ($requestedQuantity > $product->current_stock) {
            return response()->json(['message' => 'Insufficient stock available.'], 400);
        }

        // Get the authenticated user
        $customerId = auth()->user()->id; // Auth::id()

        // Find or create the cart for the customer
        $cart = auth()->user()->cart()->where('product_id', $productId)->first();
        $exist = 0;
        $quantity = min($requestedQuantity, $product->current_stock);
        
        if ($cart) {
            $cart->quantity = $quantity; 
            $cart->total_cost = $cart->quantity * $cart->price_with_discount;
            $cart->save();
            $exist = 1;
        } else {
            $cart = Cart::create([
                'user_id' => $customerId,
                'product_id' => $productId,
                'price' => $product->price,
                'price_with_discount' => $product->calc_product_price(),
                'quantity' => $quantity,
                'total_cost' => $quantity * $product->calc_product_price()
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
        $count = Cart::where('user_id',auth()->user()->id)->count(); 
        if($request->ajax()){ 
            return response()->json(['html' => $str, 'exist' => $exist, 'cart_id' => $cart->id, 'count' => $count , 'totalcost'=> $cart->total_cost ]);
        }else{
            alert('success added to cart','','success');
            return redirect()->route('frontend.product',$request->product_id);
        }
    }

    public function cart_remove_product(Request $request)
    {   
        $cart = Cart::find($request->id);
        // Check if the cart item exists
        if (!$cart) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        
        // Store quantity before deletion for potential stock restoration
        $removedQuantity = $cart->quantity;
        
        $cart->delete();

        // count of product in cart 
        $count = Cart::where('user_id', auth()->user()->id)->count();
        
        return response()->json(['message' => 'Item removed from cart successfully' , 'count' => $count]);
    }

    
}
