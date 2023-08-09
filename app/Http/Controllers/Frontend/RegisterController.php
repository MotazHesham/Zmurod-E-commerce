<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RegisterController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return view('frontend.register');
    }

    public function register_customer(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'password' => 'required|string|min:6',
            'email' => 'required|string|email|unique:users',
            
            'country' => ['required', 'in:' . implode(',', array_keys(User::CITY_SELECT))],
            'region'  =>['required', 'in:' . implode(',', array_keys(User::AREA_SELECT))],
            'complete-add'=>'required',
            'phone' => 'required|string|max:255',
            
        ]);
        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'password' => bcrypt($validatedData['password']),
            'email' => $validatedData['email'],
            'country' => $validatedData['country'],
            'phone' => $validatedData['phone'],
            'user_type' => 'customer' ,
            'address' => $validatedData['region'] . $validatedData['complete-add'],
        ]);

        $customer = Customer::create([ 
            'user_id' => $user->id,
        ]);

        // Login the user
        Auth::login($user);

        // Redirect to the desired page after successful registration
        return redirect()->route('customer.home');
    }

    public function register_seller(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'country' => ['required', 'in:' . implode(',', array_keys(User::CITY_SELECT))],
            'region'  =>['required', 'in:' . implode(',', array_keys(User::AREA_SELECT))],
            'complete-add'=>'required',
            'phone' => 'required|string|max:255',
            'store_name' => 'required|string|max:255|unique:sellers,store_name|regex:/^[A-Za-z][A-Za-z0-9_-]{3,29}$/',
            'description' => 'required|string|max:255',
        ]);
        // Create a new seller user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'country' => $validatedData['country'],
            'phone' => $validatedData['phone'],
            'user_type' => 'seller',
            'address' => $validatedData['region'] .'-'. $validatedData['complete-add'],
        ]);
        
        // Create a new seller
        $seller = Seller::create([  
            'store_name' => $validatedData['store_name'],
            'description' => $validatedData['description'],
            'user_id' => $user->id,
        ]);

        if ($request->input('photo', false)) {
            $seller->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $seller->id]);
        }

        // Login the user and redirect
        Auth::login($user);

        // Redirect to the desired page after successful registration
        return redirect()->route('seller.home');
    }

    public function storeCKEditorImages(Request $request)
    {
        $model         = new Seller();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
