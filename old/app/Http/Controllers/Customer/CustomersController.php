<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    use MediaUploadingTrait;
    public  function index()
    {   
        $orders = Order::where('user_id',auth()->user()->id)->get();
        // return $orders;
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        // return $customer;
        return view('frontend.customer.dashboard',compact('orders','customer'));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'phone' => 'required|numeric|digits:11',
            'address' => 'required|string|max:255',
        ]);
    
        $customer = Customer::where('user_id', $request->user_id)->first();
        

        if ($customer) {
            $customer->update([
                'address' => $request['address'], 
            ]);
            
    
            $user = User::find($request->user_id);
            if ($user) {
                $user->update([
                    'phone' => $request['phone'],
                ]);
            }
        }
    
        // If no errors, redirect to the desired route
        return redirect()->route('customer.home')->with('success', 'Customer information updated successfully.');
    }
    public function storeCKEditorImages(Request $request)
    {
        $model         = new Customer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
