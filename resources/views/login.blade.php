@extends('common.master')
@section('content')


  <form method="POST" name="loginForm" id="loginForm" class="form-signin w-100 m-auto" action="{{ url('/login') }}">
    @csrf
    <div class="form-floating mb-3">
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address">
      <label for="email">Email</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
      <label for="password">Password</label>
    </div>
    <button type="submit" name="loginButton" id="loginButton" class="w-100 btn btn-lg btn-primary">Login</button>
  </form>
@endsection
