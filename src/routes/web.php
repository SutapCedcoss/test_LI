<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'LightningIllusion\RetailExpress\Http\Controllers'], function () {
    Route::get('retailExpress', 'RetailExpressController@index');
    Route::post('retailExpress', 'RetailExpressController@send');
});
