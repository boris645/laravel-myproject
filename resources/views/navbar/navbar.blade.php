<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link @if(Request::route()->getName() == 'app_home') active @endif" aria-current="page" href="{{ Route('app_home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if(Request::route()->getName() == 'app_about') active @endif" aria-current="page" href="{{ Route('app_about') }}">About</a>
        </li>
      </ul>
    </div>
    <!-- Example single danger button -->
<div class="btn-group">
  @guest
    <button type="button" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      My account
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{route('register')}}">register</a></li>
      <li><a class="dropdown-item" href="{{route('login')}}">login</a></li>
    </ul>
  @endguest
  
  @auth
    <button type="button" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      {{ Auth::user()->name }}
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{route('app_logout')}}">logout</a></li>
    </ul>
  @endauth

</div>
  </div>
</nav>
