<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {   

        // validate the form 
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'shipping_address' => 'required',
            'phone' => 'required',
            'phone_2' => 'nullable',
            'email' => 'required|email',
            'message' => 'nullable',
        ]);

         // Get the last order number used and intial order number if no previous orders exist
        $lastOrder = Order::latest()->first();
        $orderNumber = 'customer#1'; 

        if ($lastOrder) {
            $lastOrderNumber = $lastOrder->order_num;
            // Remove the "#customer_order_" prefix
            $lastOrderNumber = substr($lastOrderNumber, strlen('customer#')); 
            $orderCount = intval($lastOrderNumber);
            $nextOrderCount = $orderCount + 1;
            $orderNumber = 'customer#' . $nextOrderCount;
        }

        // Calculate the total cost based on the products in the order
            $cartTotal = auth()->user()->cart()->sum('total_cost');

      
        // create order 
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'order_num' => $orderNumber ,           
            'client_name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
            'phone_number' => $validatedData['phone'],
            'phone_number_2' => $validatedData['phone_2'],
            'shipping_address' => $request->input('shipping_address') . ' ' . $request->input('address_area') ,
            'delivery_status' => 'pending',
            'total_cost' => $cartTotal,            
            'discount' => 0 ,      
            'shipment_type' => $request->input('shipment_type'),      
            'city' => $request->input('city') ,             
        ]);

        $order->save();

        // Create order products for each cart item

        $cartItems = auth()->user()->cart()->get();
         foreach ($cartItems as $cartItem) {
            OrderProduct::create([
                'product_id' => $cartItem->product_id,
                'order_id' => $order->id,
                'price' => $cartItem->price_with_discount,
                'quantity' => $cartItem->quantity,
                'total_cost' => $cartItem->total_cost,
            ]);
        }

        // delete the cart to the user 
        auth()->user()->cart()->delete() ; 

        return redirect()->route('customer.order.has.stored')->with('message', 'Order created successfully');

    }
    
    public function thank()
    {
        return view('frontend.customer.thanks');
    }
}
