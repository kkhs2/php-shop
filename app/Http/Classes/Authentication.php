<?php

class Authentication {

  public function __construct(private DatabaseTable $users, private string $usernameColumn, private string $passwordColumn) {
    
  }

}