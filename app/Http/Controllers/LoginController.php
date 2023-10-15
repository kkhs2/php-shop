<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
  public function login(Request $request) {
    $request = $request->all(); 
    $customer = DB::select('SELECT * FROM customers WHERE email = :email', [
      'email' => $request['email']
    ]);
    if (count($customer) == 0 || /*!password_verify($request['password'], $customer[0]->password)*/ $request['password'] !== $customer[0]->password) {
      return back()->with('error', 'Your username and password combination cannot be found.');
    }
    session(['customer' => $customer[0]]);
    return redirect('home')->with('success', 'You are logged in.');
   }
}
