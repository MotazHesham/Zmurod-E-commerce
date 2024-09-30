<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    public function index() 
    {
         $shipmentcost = AboutUs::find(1) ; 
         $normal = $shipmentcost->normal_shipment_cost ; 
         $fast = $shipmentcost->fast_shipment_cost ; 
        return view('frontend.checkout' , compact('normal','fast'));
    }

}
