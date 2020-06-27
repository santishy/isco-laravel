<!DOCTYPE html>
<html lang="en" style="height:100% !important">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#4285f4"/>
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#4285f4"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
   <script src="https://use.fontawesome.com/4262dce400.js"></script>
    <!-- Scripts -->
     <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script>
        function errorImage(ele){
            ele.onerror=null;
            ele.src="http://pch.com/images/noimg.jpg";

        }
    </script>
</head>
<body style="min-height:100% !important;">
    <div id="app">
        <header class="header">
            <div class="container-logo">
                <a href="http://iscocomputadoras.com" class="logo">
                    <img src="{{asset('images/logo.png')}}" class="img-fluid">
                </a>
            </div>

             <div class="d-flex justify-content-center sign-in">
              @guest
                    <div class="px-2">
                        <a class="text-blue-palette text-decoration-none" style="font-size:2em" href="{{ route('login') }}"> <i class="fas fa-sign-in-alt "></i> {{ __('LOGIN') }}</a>
                    </div>
                    <div class="verticalLine">

                    </div>
                    <div class="px-2">
                        <a class="text-blue-palette text-decoration-none"  style="font-size:2em" href="{{ route('register') }}"><i class="fas fa-address-card"></i> {{ __('REGISTRO') }}</a>
                    </div>
                @else
                    <div style="width:auto;" class="nav-item dropdown">
                        <a  id="navbarDropdown" class="text-blue-palette text-decoration-none dropdown-toggle" style="font-size:2em" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ substr(Auth::user()->name,0,9) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="z-index:10000"aria-labelledby="navbarDropdown">
                            <a style="color:black" class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
              </div>

            <div class="container-contact">
                <p class="no-margin">Comunicate también por:</p>
                        {{-- <a href="https://wa.link/v2iqaa" style="color:black;visited:black;text-decoration: none"href="tel:+018000014726" class="earphone" style="font-weight:bold">
                            <strong><span >Tel 01 800 001 isco</span></strong>
                        </a> --}}
                        <div style="display: flex;justify-content:  center; align-items:center ;width: 100%;">
                          <a href="https://wa.link/hoqrpb" class="text-decoration-none">
                            <i  class="fa fa-whatsapp fa-2x" aria-hidden="true" style="margin-right: 5px;color: green"></i><strong> 3322351553</strong>
                          </a>
                        </div>
            </div>

        </header>
        @yield('menu')
        @yield('slider')

          <main class="py-4">

          @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (session()->has('success'))
            <div class="alert alert-success">
              <ul>
                @foreach(session()->get('success') as $message)
                  <li>{{$message}}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @yield('content')
      </main>


    </div>

    @include('layouts.footer')
