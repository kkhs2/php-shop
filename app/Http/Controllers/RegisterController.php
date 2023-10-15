<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\Database;
use App\Mail\RegistrationSuccessful;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    //
    public function register(Request $request) {
      $customer = $request->input('customer');
      $customerTable = new Database('customers');
      if (!empty(trim($customer['firstName'])) && 
          !empty(trim($customer['lastName'])) && 
          filter_var($customer['email'], FILTER_VALIDATE_EMAIL) && 
          !empty($customer['password']) &&
          !$customerTable->select('email', $customer['email'])) {
          // passed all the checks so attempt to add user into database, ensure to hash the password when pushing the website into production
        //$register['password'] = password_hash($register['password'], PASSWORD_DEFAULT); 

        // a bit crap to do the $customer array like below, but it'll do for now
        $customer['houseNumberName'] = '';
        $customer['street'] = '';
        $customer['townCity'] = '';
        $customer['postCode'] = '';
        $customer['stateCounty'] = '';
        $customer['country'] = '';
        $insertCustomer = $customerTable->save($customer, 'insert');
        
        if (!$insertCustomer) {
          return back()->with('error', 'Sorry your details were not registered. Please ensure that you have entered your details correctly.');
        }

        Mail::to('shumkhk@gmail.com')->send(new RegistrationSuccessful());
        return redirect('login')->with('success', 'Your account has been created.');
        
      } else {
        // return with error message
        return back()->with('error', 'Sorry your details were not registered. Please ensure that you have entered your details correctly.');
      }
      

    }

    

}
