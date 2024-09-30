<?php
Route::group(['prefix' => 'seller', 'as' => 'seller.', 'namespace' => 'Seller', 'middleware' => ['auth', 'seller']], function () {
    // account
    Route::get('dashboard', 'HomeController@index')->name('home');
    Route::get('sales', 'SalesController@index')->name('sales');
    Route::get('allproducts', 'MyProductsController@index')->name('products.index');
    Route::get('products', 'MyProductsController@create')->name('addproduct');
    Route::post('products/add', 'MyProductsController@store')->name('products.store');
    Route::post('products/media', 'MyProductsController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'MyProductsController@storeCKEditorImages')->name('products.storeCKEditorImages');
    
});