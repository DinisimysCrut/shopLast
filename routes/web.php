<?php

Auth::routes();


Route::group(['as' => 'public.', 'namespace' => 'AllPublic'],function(){
    Route::get('categories','CategoryController@index')->name('categories.index');
    Route::get('categories/{category}','CategoryController@show')->name('categories.show');

    Route::get('products/{product}','ProductController@show')->name('products.show');

    Route::group(['middleware' => 'auth'],function() {
        Route::match(['post','put'],'basket/{product}','BasketController@store')->name('basket.store');
        Route::get('basket/{product?}','BasketController@show')->name('basket.show');
        Route::delete('basket/{product}','BasketController@destroy')->name('basket.destroy');

        Route::get('orders','MyOrderController@index')->name('orders.index');
        Route::get('orders/create','MyOrderController@create')->name('orders.create');
        Route::post('orders','MyOrderController@store')->name('orders.store');
        Route::get('orders/{order}','MyOrderController@show')->name('orders.show');
    });
});

Route::group(['middleware' => ['auth','admin'] , 'prefix' => 'admin' , 'as' => 'admin.', 'namespace' => 'Admin'], function () {

    Route::get('dashboard','DashboardController@index')->name('dashboard.index');

    Route::get('categories/{category}/confirm_destroy','CategoryController@confirmDestroy')->name('categories.confirm_destroy');
    Route::resource('categories', 'CategoryController', ['exept' => 'show']);

    Route::get('orders','MyOrderController@index')->name('orders.index');
    Route::get('orders/{order}','MyOrderController@show')->name('orders.show');

    Route::get('products/{product}/confirm_destroy','ProductController@confirmDestroy')->name('products.confirm_destroy');
    Route::resource('products', 'ProductController', ['exept' => 'show']);
    Route::post('orders/{order}','MyOrderController@updateStatus')->name('orders.update_status');
    Route::put('orders/{order}/{product}','MyOrderController@updateProduct')->name('orders.update_product');
    Route::delete('orders/{order}{product}','MyOrderController@deleteProduct')->name('orders.delete_product');
    Route::get('orders/confirm_destroy/{order}','MyOrderController@confirmDestroy')->name('orders.confirm_destroy');
    Route::delete('orders/{order}','MyOrderController@destroy')->name('orders.destroy');
});
