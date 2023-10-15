@extends('common.master')
@section('content')
@if (count($basket) > 0)

    <div class="col-md-5 align-items-center">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-primary">Your basket
      <span class="badge bg-primary rounded-pill">{{ count($basket) }}</span></h4>
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
  </div>
 



      <a href="{{ url('products') }}" name="continueShopping" class="btn btn-primary">Continue Shopping</a>
      <a href="{{ url('clearBasket') }}" name="clearBasket" class="btn btn-warning">Clear Basket</a>
      <a href="{{ url('payment') }}" name="payment" class="btn btn-primary">Proceed to Payment</a>
@else 
  <h4>Your basket is empty</h4>
@endif
@endsection