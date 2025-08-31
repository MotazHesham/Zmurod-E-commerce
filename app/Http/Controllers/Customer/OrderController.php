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
            'phone_2' => 'required',
            'shipment_type' => 'required|in:normal,fast',
            'message' => 'nullable',
        ]);

        try {
            // Check if user has items in cart
            $cartItems = auth()->user()->cart()->with('product')->get();
            if ($cartItems->isEmpty()) {
                return redirect()->back()->withErrors(['error' => 'Your cart is empty.']);
            }

            
            // Verify stock availability for all cart items
            foreach ($cartItems as $cartItem) {
                if ($cartItem->quantity > $cartItem->product->current_stock) {
                    return redirect()->back()->withErrors(['error' => 'Insufficient stock for ' . $cartItem->product->name]);
                }
            }

            // Get the last order number used and initial order number if no previous orders exist
            $lastOrder = Order::latest()->first();
            $orderNumber = 'customer#1'; 

            if ($lastOrder) {
                $lastOrderNumber = $lastOrder->order_num;
                // Remove the "#customer" prefix
                $lastOrderNumber = substr($lastOrderNumber, strlen('customer#')); 
                $orderCount = intval($lastOrderNumber);
                $nextOrderCount = $orderCount + 1;
                $orderNumber = 'customer#' . $nextOrderCount;
            }

            // Calculate the total cost based on the products in the order
            $cartTotal = auth()->user()->cart()->sum('total_cost');

            // Create order 
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'order_num' => $orderNumber,           
                'client_name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                'phone_number' => $validatedData['phone'],
                'phone_number_2' => $validatedData['phone_2'],
                'shipping_address' => $request->input('shipping_address') . ' ' . $request->input('address_area'),
                'delivery_status' => 'pending',
                'total_cost' => $cartTotal,            
                'discount' => 0,      
                'shipment_type' => $request->input('shipment_type'),      
                'city' => $request->input('city'),             
            ]);

            // Create order products for each cart item and update inventory
            foreach ($cartItems as $cartItem) {
                OrderProduct::create([
                    'product_id' => $cartItem->product_id,
                    'order_id' => $order->id,
                    'price' => $cartItem->price_with_discount,
                    'quantity' => $cartItem->quantity,
                    'total_cost' => $cartItem->total_cost,
                ]);

                // Update product inventory - THIS IS THE CRITICAL FIX
                $cartItem->product->update([
                    'current_stock' => $cartItem->product->current_stock - $cartItem->quantity
                ]);
            }

            // Clear the user's cart
            auth()->user()->cart()->delete();

            return redirect()->route('customer.order.has.stored')->with('message', 'Order created successfully');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing your order. Please try again.']);
        }
    }
    
    public function thank()
    {
        return view('frontend.customer.thanks');
    }
}
