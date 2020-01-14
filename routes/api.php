<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group(
    [
        'middleware' => ['auth:api'],
        'namespace' => 'Api\V1',
        'prefix' => 'v1'
    ], function () {

        //I was going to do a full ApiResource controller but I don't really think it makes sense in this context.
        //All we would be doing is listing and showing.
        Route::get('exchangetradedfund', 'ExchangeTradedFundController@index');
        Route::get('exchangetradedfund/ticker/{ticker}', 'ExchangeTradedFundController@ticker');
        Route::get('exchangetradedfund/{id}','ExchangeTradedFundController@show');


        //These routes handle the Ssga Service. (Pulling the actual data from Ssga)
        Route::get('ssga/available', 'SsgaController@available');
        Route::get('ssga/{identifier}', 'SsgaController@detail');

});
