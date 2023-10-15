@extends('common.master')
@section('content')
<form method="POST" name="registerForm" id="registerForm" class="form-register p-4" action="{{ url('/register') }}">
  @csrf
  <div class="form-floating mb-3">
    <select class="form-select" name="customer[title]" id="title" required>
      @include('common.titles')
    </select>
    <label for="title" class="form-label">Title</label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" name="customer[firstName]" class="form-control" id="firstName" placeholder="Enter your first name" required>
    <label for="firstName" class="form-label">First name</label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" name="customer[lastName]" class="form-control" id="lastName" placeholder="Enter your last name" required>
    <label for="lastName" class="form-label">Last name</label>
  </div>
  <div class="form-floating mb-3">
    <input type="email" name="customer[email]" class="form-control" id="email" placeholder="Enter your email address" required>
    <label for="email" class="form-label">Email Address</label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" name="customer[password]" class="form-control" id="password" placeholder="Enter your password" required>
    <label for="password" class="form-label">Password</label>
  </div>
  <button type="submit" name="register" id="registerButton" class="w-100 btn btn-lg btn-primary" value="register">Register</button>
</form>
@endsection