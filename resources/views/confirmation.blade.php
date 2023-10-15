@extends('common.master')
@section('content')

<h2>Thank you for your order.</h2>

@if (count($basket) > 0)
	<div class="row g-5">
    <div class="col-md-5 col-lg-4 order-md-last">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-primary">You have ordered:</h4>
    @foreach ($basket as $key => $val)
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h6 class="my-0">{{ $val['title'] }}</h6>
            
          </div>
          <span class="text-body-secondary">&pound;{{ number_format($val['price'], 2) }}</span>
        </li>
      
    @endforeach
    <li class="list-group-item d-flex justify-content-between"><span>Total </span><strong>&pound;{{ number_format($totalPrice, 2) }}</strong></li>
    </ul>

@endif

@endsection