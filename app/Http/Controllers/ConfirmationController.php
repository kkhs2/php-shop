<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class ConfirmationController extends Controller
{
    public function index() {
      $basket = session()->get('basket.items');
      $totalPrice = array_sum(array_values(array_column($basket, 'price')));

      Mail::to('shumkhk@gmail.com')->send(new OrderConfirmation());

      return view('confirmation', [
        'basket' => $basket,
        'totalPrice' => $totalPrice,
      ]);  
      
    }

}
