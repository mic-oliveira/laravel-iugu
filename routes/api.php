<?php


use Illuminate\Support\Facades\Route;

Route::namespace('Iugu\\Controllers\\Api')->middleware('api')->prefix('api/iugu')->group(function() {

    Route::apiResource('address','AddressController');
});

Route::namespace('Iugu\\Controllers\\Hooks')->prefix('api/hooks')->group(function() {
    Route::group(['prefix'=>'subscriptions'], function (){
        Route::post('suspended','SusbcriptionController@suspendend');
        Route::post('activated','SubscriptionController@activated');
    });

    Route::group(['prefix'=>'invoices'], function () {

    });
});

