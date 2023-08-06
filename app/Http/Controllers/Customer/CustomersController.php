<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Customer;
use App\Models\Order;
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

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        @dd($request->all());
        if($request->input('personal_photo', false)) {
            if (!$customer->personal_photo || $request->input('personal_photo') !== $customer->personal_photo->file_name) {
                if ($customer->personal_photo) {
                    $customer->personal_photo->delete();
                }
                $customer->addMedia(storage_path('tmp/uploads/' . basename($request->input('personal_photo'))))->toMediaCollection('personal_photo');
            }
        } elseif ($customer->personal_photo) {
            $customer->personal_photo->delete();
        }
        // If no errors, redirect to the desired route
        return redirect()->route('customer.home');
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
