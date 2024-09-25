<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MyProductsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();

        return view('frontend.seller.products', compact('products'));
    }

    public function create()
    {
        $product_categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('frontend.seller.addproduct', compact('product_categories'));
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('seller.products.index');
    
    }

    public function edit($id)
    {
        $product_categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $product = Product::find($id);
        return view('frontend.seller.edit_product', compact('product_categories','product'));
    }

    public function update(Request $request ,$id)
    {
        $product = Product::find($id);
        
        $product->update($request->all());
        if (count($product->image) > 0) {
            foreach ($product->image as $media) {
                if (! in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }
      

        return redirect()->route('seller.products.index');
    
    }

    

    public function storeCKEditorImages(Request $request)
    {
        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
