@extends('common.master')
@section('content')
  <div class="p-5 mb-4 bg-body-tertiary rounded-3">
    <div class="container-fluid mt-4 py-5">
      <h1 class="display-5 fw-bold">Demo shop site</h1>
      <p class="col-md-8 fs-4">The purpose of this site is to demonstrate the use of PHP (Laravel framework), MySQL, JavaScript, consuming JSON REST API for shop products, and a payment integration (Adyen).</p>
      <a href="{{ url('/products') }}" class="btn btn-primary">See products</a>
      <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
      <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
    </div>
  </div>
@endsection