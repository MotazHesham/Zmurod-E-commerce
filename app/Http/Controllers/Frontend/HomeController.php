<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Course;
use App\Models\Product;


class HomeController extends Controller
{
    // Index.blase View
    public function index()
    {
        // get the active slider to show it in the view
        $sliders = Slider::where('status', 1)->get();
        // get the  most recent categories to use it in view
        $Resent_categories = Category::with('products')->where('most_recent', 1)->orderBy('updated_at', 'desc')->get()->take(6);
        // get the  Fav categories to use it in view
        $Favs_categories = Category::where('fav', 1)->with(['products' => function ($query) {
            $query->with('product_offers')->where('fav', 1)->orderby('updated_at', 'desc');
        }])->orderby('updated_at', 'desc')->get()->take(5);

        // get all banners
        $banners = Banner::all();

        // Sellers

        return view('frontend.index', compact('sliders', 'Resent_categories', 'Favs_categories', 'sliders', 'banners'));
    }
    // courses.blade
    function Course()
    {   //courses
        $courses = Course::all();
        // course category
        $categories = Category::all();
        return view('frontend.courses', compact('courses', 'categories'));
    }
    public function singlecourse($id)
    {
        // Fetch the course by ID from the database
        $course = Course::find($id);
        // Pass the course data to the view
        return view('frontend.singlecourse')->with('course', $course);
    }
}
