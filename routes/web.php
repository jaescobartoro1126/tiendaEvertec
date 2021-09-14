<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\Products::class, 'index']);

Route::post('/createOrders', [\App\Http\Controllers\OrdersController::class, 'create']);
Route::get('/orderPay/{order}', [\App\Http\Controllers\OrdersController::class, 'orderPay']);
Route::post('/orderPay/{order}', [\App\Http\Controllers\OrdersController::class, 'pay']);
Route::get('/orders', [\App\Http\Controllers\OrdersController::class, 'index']);
Route::get('/order/{id}', [\App\Http\Controllers\OrdersController::class, 'show']);


Route::get('/orderds', function (\Illuminate\Http\Request $request) {
    $placetopay = new Dnetix\Redirection\PlacetoPay([
        'login' => '6dd490faf9cb87a9862245da41170ff2',
        'tranKey' => '024h1IlD',
        'url' => 'https://dev.placetopay.com/redirection/',
        'rest' => [
            'timeout' => 45, // (optional) 15 by default
            'connect_timeout' => 30, // (optional) 5 by default
        ]
    ]);
    $response = $placetopay->query(44914);

    if ($response->isSuccessful()) {
        // In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class

        if ($response->status()->isApproved()) {
            dd('aca');
        }
        if ($response->status()->isRejected()) {
            // The payment has been approved
        }
    } else {
        // There was some error with the connection so check the message
        print_r($response->status()->message() . "\n");
    }
    dd($response);
});


