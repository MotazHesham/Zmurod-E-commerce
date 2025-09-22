<?php

use App\Http\Livewire\Popup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;


Auth::routes(['verify' => true]);

Route::group(['as' => 'frontend.', 'namespace' => 'Auth'], function () {
    // login
    Route::get('userlogin', 'CustomLoginController@index')->name('userlogin');
    // register
    Route::get('register', 'CustomRegisterController@index')->name('register');
    Route::post('seller-register', 'CustomRegisterController@register_seller')->name('register_seller');
    Route::post('customer', 'CustomRegisterController@register_customer')->name('register_customer');
    Route::post('sellers/media', 'CustomRegisterController@storeMedia')->name('sellers.storeMedia');
    Route::post('sellers/ckmedia', 'CustomRegisterController@storeCKEditorImages')->name('sellers.storeCKEditorImages');
});

// Note: Password reset routes are already included in Auth::routes() above
// No need to redefine them here

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {
    // Home
    Route::get('/', 'HomeController@index')->name('home');

    //course
    Route::get('courses', 'CourseController@index')->name('courses.index');
    Route::get('courses/{id}', 'CourseController@show')->name('courses.show');
    Route::post('courses/search', 'CourseController@search')->name('courses.search');
    Route::post('courses/{id}/subscribe', 'CourseController@subscribe')->name('courses.subscribe');

    // about and Contact
    Route::get('about', 'AboutController@index')->name('about-us');

    // blogs    
    Route::get('blogs', 'BlogController@index')->name('blogs.index');
    Route::get('blogs/{id}', 'BlogController@show')->name('blogs.show');

    Route::post('storeComment', 'BlogController@storeComment')->name('storeComment');

    // forums
    Route::get('forums', 'ForumController@index')->name('forums');
    Route::get('forum/{id}', 'ForumController@show')->name('post');
    Route::post('forum/post/comment', 'ForumController@comment')->name('post.comment');

    // cart & whitelist
    Route::get('cart', 'CartController@index')->name('cart');

    // product
    Route::get('product/{id}', 'ProductController@show')->name('product');
    Route::get('show_popup', 'ProductController@show_popup')->name('productpopup');
    Route::post('rating', 'ProductController@rating')->name('rating');

    // checkout
    Route::get('checkout', 'CheckoutController@index')->name('checkout');

    // course content (authenticated users only)
    Route::get('courses/{courseId}/content', 'CourseController@content')
        ->name('courses.content')
        ->middleware(['auth', 'course.subscription', 'youtube.embeds']);
    Route::get('courses/{courseId}/watch/{contentId}', 'CourseController@watch')
        ->name('courses.watch')
        ->middleware(['auth', 'course.subscription', 'youtube.embeds']);

    // downloads (authenticated users only)
    Route::get('courses/{courseId}/download/{contentId}', 'DownloadController@downloadVideo')
        ->name('courses.download.video')
        ->middleware(['auth', 'course.subscription']);
    Route::get('courses/{courseId}/download-all', 'DownloadController@downloadAllCourseVideos')
        ->name('courses.download.all')
        ->middleware(['auth', 'course.subscription']);
    Route::get('my-downloads', 'DownloadController@myDownloads')
        ->name('downloads.index')
        ->middleware('auth');

    // Debug route for testing video uploads
    Route::get('debug-video/{id}', function($id) {
        $content = App\Models\CourseContent::find($id);
        if (!$content) {
            return 'Content not found';
        }
        
        return response()->json([
            'id' => $content->id,
            'title' => $content->title,
            'video_url' => $content->video_url,
            'video_file' => $content->video_file,
            'storage_url' => $content->video_file ? Storage::url($content->video_file) : null,
            'file_exists' => $content->video_file ? Storage::disk('public')->exists($content->video_file) : false,
        ]);
    });
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer'], function () {
    // shops
    Route::get('shops', 'ShopController@index')->name('shops');
    Route::get('shop/{id}', 'ShopController@shop')->name('shop');
    Route::get('shop', 'ShopController@show')->name('marketshop');

    //Contact
    Route::get('contact', 'ContactController@index')->name('contact-us');
    Route::Post('/send', 'ContactController@store')->name('sendmessage');

    // pop up model 
    Route::post('pop', 'PopupModalController@show')->name('popup.show');
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth', 'customer', 'verified']], function () {
    // account
    Route::get('dashboard', 'CustomersController@index')->name('home');
    Route::post('dashboard/media', 'CustomersController@storeMedia')->name('customers.storeMedia');
    Route::post('dashboard/ckmedia', 'CustomersController@storeCKEditorImages')->name('customers.storeCKEditorImages');

    Route::post('dashboard/update', 'CustomersController@update')->name('customers.update');
    
    // cart with rate limiting
    Route::get('cart/show', 'CartController@show')->name('cart.show');
    Route::post('cart/store', 'CartController@cart_store_product')->name('cart.store')->middleware('throttle.cart');
    Route::post('cart/update', 'CartController@updateCart')->name('cart.update')->middleware('throttle.cart');
    Route::delete('cart/remove', 'CartController@cart_remove_product')->name('cart.remove')->middleware('throttle.cart');
    
    //whitelist
    Route::get('whitelist/show', 'WhitelistController@show')->name('whitelist.show');
    Route::post('whitelist/store', 'WhitelistController@store')->name('whitelist.store');
    Route::delete('whitelist/remove', 'WhitelistController@destroy')->name('whitelist.remove');

    // order 
    Route::post('order/store', 'OrderController@store')->name('order.store');

    // thanks page 
    Route::get('thanks', 'OrderController@thank')->name('order.has.stored');
});
