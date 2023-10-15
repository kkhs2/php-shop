@extends('common.master')
@section('content')
@if (count($basket) > 0)

  <div class="row g-5">
    <div class="col-md-5 col-lg-4 order-md-last">
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
  <div class="col-md-7 col-lg-8">
    <h4 class="mb-3">Billing Address</h4>
    <form method="POST" class="form pb-4" name="payment" id="payment" action="{{ url('payment') }}">
      @csrf
    <div class="row g-3">
      
      <div class="col-12">
        <div class="form-floating">
          <input type="text" class="form-control" id="houseNumberOrName" name="billingAddress[houseNumberOrName]" placeholder="Address Line 1" value="380" required>
          <label>House number / name</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
          <input type="text" class="form-control" name="billingAddress[street]" placeholder="Address Line 2" value="Midsummer Boulevard" required>
          <label>Street</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
          <input type="text" class="form-control" name="billingAddress[city]" placeholder="Town/City" value="Milton Keynes" required>
          <label>Town / City</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
          <input type="text" class="form-control" name="billingAddress[postalCode]" placeholder="Post Code" value="MK9 2EA" id="postalCode" required>
          <label>Post Code</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
          <input type="text" class="form-control" name="billingAddress[stateOrProvince]" placeholder="State / Province" value="Buckinghamshire">
          <label>State / Province / County</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
          <select class="form-select" name="billingAddress[country]">
            <option value="">Please select country</option>
            <option value="GB" selected>United Kingdom</option>
            <option value="US">United States</option>
            <option value="HK">Hong Kong</option>
          </select>
          <label>Country</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
          <select class="form-select" name="paymentMethod[type]" id="cardType" required>
            <option value="">Please select card type</option>
            @foreach ($paymentMethods as $k => $v)
              <option value="{{ $v }}">{{ $v }}</option>
            @endforeach
          </select>
          <label>Card Type</label>
        </div>
      </div>

      <div class="col-12">
        <div class="form-floating">
          <input type="text" name="paymentMethod[holderName]" id="holderName" class="form-control" placeholder="Card holder name" value="MR K SHUM" required>
          <label>Card Holder Name</label>
        </div>
      </div>

      <div class="col-12">
        <div class="form-floating">
          <input type="text" name="paymentMethod[encryptedCardNumber]" id="encryptedCardNumber" class="form-control" placeholder="Enter card number" value="test_4917610000000000" required>
          <label>Card Number</label>
        </div>
      </div>
  
    <div class="col-6">
      <div class="form-floating">
        <select class="form-select" name="paymentMethod[encryptedExpiryMonth]" id="encryptedExpiryMonth" placeholder="Enter expiry month" required>
          <option value="">Please select</option>
          <option value="test_01">January</option>
          <option value="test_02">February</option>
          <option value="test_03" selected>March</option>
          <option value="test_04">April</option>
          <option value="test_05">May</option>
          <option value="test_06">June</option>
          <option value="test_07">July</option>
          <option value="test_08">August</option>
          <option value="test_09">September</option>
          <option value="test_10">October</option>
          <option value="test_11">November</option>
          <option value="test_12">December</option>
        </select>
        <label>Card Expiry Month</label>
      </div>
    </div>
    <div class="col-6">
      <div class="form-floating">
        <select class="form-select dropdown" name="paymentMethod[encryptedExpiryYear]" id="expiryYear" placeholder="Enter card expiry year" required>
          <option value="">Please select</option>
          <option value="test_2023">2023</option>
          <option value="test_2024">2024</option>
          <option value="test_2025">2025</option>
          <option value="test_2026">2026</option>
          <option value="test_2027">2027</option>
          <option value="test_2028">2028</option>
          <option value="test_2029">2029</option>
          <option value="test_2030" selected>2030</option>
          <option value="test_2031">2031</option>
          <option value="test_2032">2032</option>
          <option value="test_2033">2033</option>
        </select>
        <label>Card Expiry Year</label>
      </div>
    </div>
    <div class="col-6">
      <div class="form-floating">
        <input type="text" name="paymentMethod[encryptedSecurityCode]" id="securityCode" class="form-control" value="test_737" required>
        <label for="securityCode">Security Code</label>
      </div>
    </div>
    <div class="col-12">
      <div class="form-floating">
        <input type="email" name="shopperEmail" id="shopperEmail" class="form-control" value="shumkhk@gmail.com" required>
        <label>Email Address</label>
      </div>
    </div>

    <button type="submit" name="paySubmit" class="w-100 btn btn-primary btn-lg btn btn-primary">Pay</button>
    <input type="hidden" name="amount[currency]" value="GBP">
    <input type="hidden" name="amount[value]" value="{{ $totalPrice }}">
    <input type="hidden" name="returnUrl" value="{{ url('payment') }}">
    <input type="hidden" name="reference" value="{{ $reference }}">
    <input type="hidden" name="clientKey" value="{{ $clientKey }}">
</form>
</div>
</div>

@endif
@endsection