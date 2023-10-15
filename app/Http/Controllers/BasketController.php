<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class BasketController extends Controller
{
    /*
     *  The basket for this site is designed to have one item to be added at a time (instead of specifying quantity of each item as well like a supermarket).  
     */

    public function index() {

        $basket = session()->get('basket.items') ?? null;
        $totalPrice = array_sum(array_values(array_column($basket, 'price')));
        if (!$basket) {
            return redirect('products')->with('error', 'Your basket is empty.');
        }
        return view('basket', [
            'basket' => $basket,
            'totalPrice' => $totalPrice
        ]);
    }

    public function clearBasket() {
      
      return redirect('products')->with('error', 'Your basket is empty.');
    }

}
