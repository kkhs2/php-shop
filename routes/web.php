<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\HomeController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
  return view('login');
});

Route::get('register', function () {
  return view('register');
});

Route::get('products', [ProductsController::class, 'index']);

Route::get('basket', [BasketController::class, 'index']);

Route::post('clearBasket', [BasketController::class, 'clearBasket']);

Route::get('payment', [PaymentController::class, 'index']);

Route::get('payment/threeds', [PaymentController::class, 'threedsIndex']);

Route::post('payment/threeds', [PaymentController::class, 'threedsProcess']);

Route::get('confirmation', [ConfirmationController::class, 'index']);


Route::post('payment', [PaymentController::class, 'payment']);

Route::post('addToBasket', [ProductsController::class, 'addToBasket']);

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'login']);

Route::get('home', [HomeController::class, 'index']);

Route::get('yourdetails', [HomeController::class, 'customerDetails']);

Route::post('logout', [LogoutController::class, 'index']);

Route::get('webhook', [WebhookController::class, 'index']);