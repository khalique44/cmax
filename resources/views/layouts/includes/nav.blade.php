<?php



$header_logo = App\Http\Helpers\RosenHelper::getOption('header_logo');



?>



<nav class="navbar navbar-expand-md navbar-dark" id="navbar">

  <a class="navbar-brand" href="{{ url('/') }}"><img src="@if(!empty($header_logo))  {!! url('public') !!}/{{$header_logo}} @else {!! url('public/assets/images/logo-white.png') !!} @endif"></a>

  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>

  <div class="navbar-collapse collapse" id="navbarCollapse" style="">

    <ul class="navbar-nav ml-auto">

      <li class="nav-item active">

        <a class="nav-link" href="{{ url('/home') }}">Hem</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="{{ url('/omboende') }}">Om Boende</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="{{ url('/forboende') }}">För Boende</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="{{ url('/blog') }}">Blogg</a>

      </li>
      
      <li class="nav-item">

        <a class="nav-link btn btn-success" href="{{ url('/kontakta') }}">Kontakta Oss</a>

      </li>
      @auth('web')

      
      <li class="nav-item"><a class="nav-link btn btn-success btn-inverse" href="{{ url('/logout') }}">{{ __('language.Logga Out') }}</a></li>

      <!-- <li class="nav-item dropdown">
        <a class="nav-link btn btn-success btn-inverse dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" href="#">{{ __('language.My Account') }}</a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="{{ url('/dashboard') }}">{{ __('language.Dashboard') }}</a></li>
          <li><a class="dropdown-item" href="{{ url('/logout') }}">{{ __('language.Logga Out') }}</a></li>
        </ul>
      </li> -->
     
      @endauth


      @guest

      <li class="nav-item">
        <a class="nav-link btn btn-success btn-inverse" href="{{ url('/login') }}">Logga In</a>
      </li>

      @endguest
      
    </ul>

    

  </div>

</nav>