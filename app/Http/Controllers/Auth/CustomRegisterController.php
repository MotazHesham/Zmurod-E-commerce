<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Organization;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Validation\Rule;
use App\Rules\UniqueEmailRule;



class CustomRegisterController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        $organizations= Organization::all();
        return view('auth.custom-register',compact('organizations'));
    }

    public function register_customer(Request $request)
    {

        // Validate the input
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:50',
            'email' => [
                'required',
                'string',
                'email',
               new UniqueEmailRule
            ],
            'customer_password' => 'required|string|min:8',
            'customer_country' => ['required', 'in:' . implode(',', array_keys(User::CITY_SELECT))],
            'customer_region'  => ['required', 'in:' . implode(',', array_keys(User::AREA_SELECT))],
            'customer_complete-add' => 'required',
            'customer_phone' => 'required|string|max:255|unique:users,phone',

        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['customer_name'],
            'password' => bcrypt($validatedData['customer_password']),
            'email' => $validatedData['email'],
            'country' => $validatedData['customer_country'],
            'phone' => $validatedData['customer_phone'],
            'user_type' => 'customer',
            'address' => $validatedData['customer_region'] . $validatedData['customer_complete-add'],
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
        ]);

        // Login the user
        Auth::login($user);

        // Redirect to the desired page after successful registration
        return redirect()->route('customer.home')->with('status', 'تحقق من بريدك الإلكتروني.');;
    }

    public function register_seller(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
           'email' => [
                'required',
                'string',
                'email',
               new UniqueEmailRule
            ],
            'password' => 'required|string|min:8',
            'country' => ['required', 'in:' . implode(',', array_keys(User::CITY_SELECT))],
            'region'  => ['required', 'in:' . implode(',', array_keys(User::AREA_SELECT))],
            'complete-add' => 'required',
            'phone' => 'required|string|max:255|unique:users,phone',
            'store_name' => 'required|string|max:255|unique:sellers,store_name|regex:/^[A-Za-z][A-Za-z0-9_ -]{2,28}$/',
            'description' => 'required|string|max:255',
            'identity_number'=>'required|string|max:255|unique:users,identity_number',
            'seller_type' => 'required|in:individual,organization,affiliated',
            'organization_name' => 'nullable|string|max:255|required_if:seller_type,organization',
            'organization_id' => 'nullable|exists:organizations,id|required_if:seller_type,affiliated',
            'document_type' => 'required|in:commercial_register,freelance_work',
            'commercial_register_document' => 'nullable|string|max:255|required_if:document_type,commercial_register',
            'commercial_register_expiry' => 'nullable|date|required_if:document_type,commercial_register',
            'commercial_register_number' => 'nullable|string|max:255|required_if:document_type,commercial_register',
            'tax_number' => 'nullable|string|max:255|required_if:document_type,commercial_register',
            'freelance_work_document' => 'nullable|string|max:255|required_if:document_type,freelance_work',
            'freelance_work_number' => 'nullable|string|max:255|required_if:document_type,freelance_work',
            'bank_id' => 'required|exists:banks,id',
            'account_number' => 'required|string|max:255',
            'iban' => 'required|string|max:255',
        ]);


        // Handle organization based on seller type
        $organizationId = null;
        if ($validatedData['seller_type'] === 'organization') {
            // Create new organization
            $organization = \App\Models\Organization::create([
                'name' => $validatedData['organization_name'],
                'description' => 'منظمة جديدة',
                'user_id' => null, // Will be set after user creation
            ]);
            $organizationId = $organization->id;
        } elseif ($validatedData['seller_type'] === 'affiliated') {
            // Use existing organization
            $organizationId = $validatedData['organization_id'];
        }

        // Create a new seller user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'country' => $validatedData['country'],
            'phone' => $validatedData['phone'],
            'user_type' => 'seller',
            'address' => $validatedData['region'] . '-' . $validatedData['complete-add'],
            'identity_number'=>$validatedData['identity_number'],
        ]);

        // Create a new seller
        $seller = Seller::create([
            'store_name' => $validatedData['store_name'],
            'description' => $validatedData['description'],
            'user_id' => $user->id,
            'organization_id' => $organizationId,
            'bank_id' => $validatedData['bank_id'],
            'account_number' => $validatedData['account_number'],
            'iban' => $validatedData['iban'],
            'document_type' => $validatedData['document_type'],
            'commercial_register_document' => $validatedData['commercial_register_document'] ?? null,
            'commercial_register_expiry' => $validatedData['commercial_register_expiry'] ?? null,
            'commercial_register_number' => $validatedData['commercial_register_number'] ?? null,
            'tax_number' => $validatedData['tax_number'] ?? null,
            'freelance_work_document' => $validatedData['freelance_work_document'] ?? null,
            'freelance_work_number' => $validatedData['freelance_work_number'] ?? null,
        ]);

        // If this is a new organization, update it with the user_id
        if ($validatedData['seller_type'] === 'organization' && $organizationId) {
            \App\Models\Organization::where('id', $organizationId)->update(['user_id' => $user->id]);
        }

        if ($request->input('photo', false)) {
            $seller->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('commercial_register_document', false)) {
            $seller->addMedia(storage_path('tmp/uploads/' . basename($request->input('commercial_register_document'))))->toMediaCollection('commercial_register_document');
        }

        if ($request->input('freelance_work_document', false)) {
            $seller->addMedia(storage_path('tmp/uploads/' . basename($request->input('freelance_work_document'))))->toMediaCollection('freelance_work_document');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $seller->id]);
        }

        // Login the user and redirect
        Auth::login($user);

        // Redirect to the desired page after successful registration
        return redirect()->route('seller.home')->with('status', 'تحقق من بريدك الإلكتروني.');

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
