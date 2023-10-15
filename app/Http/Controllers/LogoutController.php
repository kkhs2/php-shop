<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function index(Request $request) {
      $request = $request->all();
      if (isset($request['action']) && $request['action'] == 'logout')
      session()->flush();
      return redirect('login')->with('success', 'You have logged out.');
      
    }
}
