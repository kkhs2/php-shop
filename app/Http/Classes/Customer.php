<?php
namespace App\Http\Classes;

use DB;

class Customer {

  public function __construct(private $customer) {
    
  }

  public function getCustomer() {
    return $this->customer;
  }


  public function getEmail() {
    return $this->customer->email;
  }


  public function insertCustomer() {
    $customer = new Database('customers');
  }
}