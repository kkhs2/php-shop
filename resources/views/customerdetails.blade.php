@extends('common.master')
@section('content')
<form method="POST" class="form-signin w-100 m-auto" action="{{ url('customerDetails') }}">
	<div class="form-floating mb-3">
		<input type="text" name="firstName" id="firstName" class="form-control" value="{{ Session::get('customer')->firstName ?? '' }}">
		<label for="firstName">First Name</label>
	</div>
	<div class="form-floating mb-3">
		<input type="text" name="lastName" id="lastName" class="form-control" value="{{ Session::get('customer')->lastName ?? '' }}">
		<label for="lastName">Last Name</label>
	</div>
	<div class="form-floating mb-3">
		<input type="text" name="houseNumberName" id="houseNumberName" class="form-control" value="{{ Session::get('customer')->houseNumberName ?? '' }}">
		<label for="houseNumberName">House Number / Name</label>
	</div>
	<div class="form-floating mb-3">
		<input type="text" name="street" id="street" class="form-control" value="{{ Session::get('customer')->street ?? '' }}">
		<label for="street">Street</label>
	</div>
	<div class="form-floating mb-3">
		<input type="text" name="townCity" id="townCity" class="form-control" value="{{ Session::get('customer')->townCity ?? '' }}">
		<label for="townCity">Town / City</label>
	</div>
	<div class="form-floating mb-3">
		<input type="text" name="postCode" id="postCode" class="form-control" value="{{ Session::get('customer')->postCode ?? '' }}">
		<label for="postCode">Postcode</label>
	</div>
	<button type="submit" class="w-100 btn btn-lg btn-primary" name="customerDetails">Update</button>
</form>
@endsection