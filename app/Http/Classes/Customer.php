<?php
namespace App\Http\Classes;

use DB;

class User {
  private $title;
  private $firstName;
  private $lastName;
  private $email;
  private $password;

  public function __construct(private array $user) {
    
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function getEmail() {
    return $this->email;
  }


  public function insertUser() {
    $user = new Database('customer');
    
  }
}