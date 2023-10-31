<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo shop</title>
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=512&id=42309&format=png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script
		src="https://code.jquery.com/jquery-3.7.1.js"
		integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
		crossorigin="anonymous"></script>
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
  </head>
  <body>
    <header data-bs-theme="dark">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand text-white">
            <!-- svg logo -->
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
              <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
            </svg>
            <!-- end svg logo -->
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item col-6 col-lg-auto">
                <a class="nav-link py-2 px-0 px-lg-2 text-white" href="{{ url('products') }}">Products</a>
              </li>
              @if (Session::has('customer'))
              <li class="nav-item col-6 col-lg-auto">
                <form method="POST" action="{{ url('logout') }}">
                @csrf
                <input type="hidden" name="action" value="logout">
                <button type="submit" class="nav-link py-2 px-0 px-lg-2 text-white">Logout</button>
              </form>
            </li>
            @else
            <li class="nav-item col-6 col-lg-auto">
              <a class="nav-link py-2 px-0 px-lg-2 text-white" href="{{ url('login') }}">Login</a>
            </li>
            <li class="nav-item col-6 col-lg-auto">
              <a class="nav-link py-2 px-0 px-lg-2 text-white" href="{{ url('register') }}">Register</a>
            </li>
            @endif
            @if (Session::has('basket'))
              <li class="nav-item col-6 col-lg-auto">
                <a class="nav-link py-2 px-0 px-lg-2 text-white" href="{{ url('basket') }}">Basket <span class="badge bg-secondary text-white rounded-pill">{{ count(Session::get('basket.items')) }}</span></h4></a>
              </li>
              <li class="nav-item col-6 col-lg-auto">
                <a class="nav-link py-2 px-0 px-lg-2 text-white" href="{{ url('payment') }}">Payment</a>
              </li>
            @endif
           
          </ul>
        </div>
      </nav>
  
    </header>
    <main class="container">
        @include('common.flashmessage')
      <div class="container mt-2 pb-2">
        @yield('content')
      </div>
    </main>
    <footer class="footer mt-2">
        @include('common.footer')
    </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
	  <script type="text/javascript" src="https://unpkg.com/babel-standalone@6/babel.js"></script>
  </body>
</html>