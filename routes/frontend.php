<?php

use App\Http\Livewire\Popup;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'frontend.', 'namespace' => 'Auth'], function () {
    // login
    Route::get('userlogin', 'CustomLoginController@index')->name('userlogin');
    // register
    Route::get('register', 'CustomRegisterController@index')->name('register');
    Route::post('seller', 'CustomRegisterController@register_seller')->name('register_seller');
    Route::post('customer', 'CustomRegisterController@register_customer')->name('register_customer');
    Route::post('sellers/media', 'CustomRegisterController@storeMedia')->name('sellers.storeMedia');
    Route::post('sellers/ckmedia', 'CustomRegisterController@storeCKEditorImages')->name('sellers.storeCKEditorImages');
});

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {
    // Home
    Route::get('/', 'HomeController@index')->name('home');


    //course
    Route::get('course', 'HomeController@course')->name('courses');
    Route::get('courses/{id}', 'HomeController@singlecourse')->name('singlecourse');

    // about and Contact
    Route::get('about', 'AboutController@index')->name('about-us');

    // blogs    
    Route::get('blogs', 'BlogController@index')->name('blogs');
    Route::get('blogs/{id}', 'BlogController@show')->name('blogbyid');
    Route::post('storeBlogComment/{id}', 'BlogController@storeBlogComment')->name('storeBlogComment');

    // forums
    Route::get('forums', 'ForumController@index')->name('forums');
    Route::get('forum/{id}', 'ForumController@show')->name('post');

    // cart & whhitelist
    Route::get('cart', 'CartController@index')->name('cart');

    // product
    Route::get('product/{id}', 'ProductController@show')->name('product');
    Route::get('show_popup', 'ProductController@show_popup')->name('productpopup');
    Route::post('rating', 'ProductController@rating')->name('rating');

    // checkout
    Route::get('checkout', 'CheckoutController@index')->name('checkout');
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

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth', 'customer']], function () {
    // account
    Route::get('dashboard', 'CustomersController@index')->name('home');
    Route::post('dashboard/media', 'CustomersController@storeMedia')->name('customers.storeMedia');
    Route::post('dashboard/ckmedia', 'CustomersController@storeCKEditorImages')->name('customers.storeCKEditorImages');

    Route::post('dashboard/update', 'CustomersController@update')->name('customers.update');
    // cart
    Route::get('cart/show', 'CartController@show')->name('cart.show');
    Route::post('cart/store', 'CartController@cart_store_product')->name('cart.store');
    Route::post('cart/update', 'CartController@updateCart')->name('cart.update');
    Route::delete('cart/remove', 'CartController@cart_remove_product')->name('cart.remove');
    //whitelist
    Route::get('whitelist/show', 'WhitelistController@show')->name('whitelist.show');
    Route::post('whitelist/store', 'WhitelistController@store')->name('whitelist.store');
    Route::delete('whitelist/remove', 'WhitelistController@destroy')->name('whitelist.remove');

    // order 
    Route::post('order/store', 'OrderController@store')->name('order.store');

    // thanks page 
    Route::get('thanks', 'OrderController@thank')->name('order.has.stored');
});
