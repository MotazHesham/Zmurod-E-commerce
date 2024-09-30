<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($id) {
        $product = Product::findOrFail($id) ;
        $product->load('product_category','reviews.user_review','product_tags');
        $related_products = Product::with('media','product_category','product_offers')->where('id','!=',$product->id)->where('product_category_id',$product->product_category_id)->take(8)->get();
        return view('frontend.product' , compact('product','related_products'));
    }

    public function show_popup($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.productpopup'  ,compact('product'));
    }

    

    public function rating(Request $request){ 
        $review = Review::where('user_review_id',Auth::id())->where('product_review_id',$request->product_id)->first();
        if(!$review){
            $review = Review::create([
                'rating' => $request->rating ?? 1,
                'comment' => $request->comment ?? 'none',
                'user_review_id' => Auth::id(),
                'product_review_id' => $request->product_id,
                'published' => 1, 
            ]);
            
            if($review){
                $product = Product::findOrFail($request->product_id);
                $reviews_count = count(Review::where('product_review_id', $product->id)->where('published', 1)->get());
                if($reviews_count > 0){
                    $product->rating = Review::where('product_review_id', $product->id)->where('published', 1)->sum('rating') / $reviews_count;
                }else {
                    $product->rating = 0;
                }
                $product->save(); 
            }
            alert('Review Added Successfully','','success');
        }else{
            alert('You added review to this product before','','warning');
        }
        return redirect()->route('frontend.product',$request->product_id); 
    }

}
