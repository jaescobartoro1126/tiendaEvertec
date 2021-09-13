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


