<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
      
      if (!session()->has('customer')) {
        return back()->with('error', 'You are not logged in.');
      }
      return view('home', [
        'customer' => session()->get('customer')
      ]);
    }

    public function customerDetails() {
      return view('customerdetails');
    }
    
}
