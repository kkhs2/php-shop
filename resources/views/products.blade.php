@extends('common.master')
@section('content')
  <div class="row mt-3 mb-3">
      <div class="col-md-4 offset-md-8">
        <div class="form-floating">
          <select class="form-select">
            <option value="">Please select</option>
            <option value="priceAsc">Price low to high</option>
            <option value="priceDesc">Price high to low</option>
            <option value="recommended">Rating</option>
            <option value="latest">Added</option>
          </select>
          <label for="floatingSelect">Sort By</label>
        </div>
      </div>
    </div>
  <form method="POST" class="form pb-4" id="basketForm" name="basketForm" action="{{ url('addToBasket') }}">
    @csrf
    
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
      @foreach ($products as $key => $val)
      <div class="col d-flex">
        <div class="card">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em"></text>
          <rect width="100%" height="100%" fill="#868e96"></rect>
        </svg>
        <div class="card-body">
          
          <h5 class="card-title">{{ $val['title'] }}</h5>
          <p class="card-text">{{ $val['description'] }}</p>
          <p class="card-text"><small class="text-muted">&pound;{{ number_format($val['price'], 2) }}</small></p>
          <input type="hidden" name="product{{ $val['id'] }}[id]" value="{{ $val['id'] }}">
          <input type="hidden" name="product{{ $val['id'] }}[title]" value="{{ $val['title'] }}">
          <input type="hidden" name="product{{ $val['id'] }}[description]" value="{{ $val['description'] }}">
          <input type="hidden" name="product{{ $val['id'] }}[price]" value="{{ $val['price'] }}">
          <input type="hidden" name="product{{ $val['id'] }}[image]" value="{{ $val['image'] }}">
          <button type="submit" name="submit" class="btn btn-sm btn-success" value="{{ $val['id'] }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2" viewBox="0 0 16 16">
          <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
          <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
          </svg>Add to Basket</button>
        </div>            
      </div>
    </div>
    @endforeach
  </div>
 
</form>
<script type="text/babel">
    /*const { useState } = React;
    const products = {{ Js::from($products) }};
    function App() {
      const [state, setState] = useState();
    }*/
    
  </script>
@endsection