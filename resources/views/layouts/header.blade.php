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
            <div class="container-search">
                <form action="{{url('search/')}}"  method="post"  id="formSearch">
                    <div class="input-form">

                        <input type="text" name="word" id="word" value="{{old('word')}}">
                        <label for="word">Busca productos</label>
                        {{ csrf_field() }}
                    </div>
                </form>
            </div>
            <div class="container-contact">
                <p class="no-margin">Llamanos por cualquier duda sobre tu pedido:</p>
                        <a style="color:black;visited:black;text-decoration: none"href="tel:+018000014726" class="earphone" style="font-weight:bold">
                            <strong><span >Tel 01 800 001 isco</span></strong>
                        </a>
                        <div style="display: flex;justify-content:  center; align-items:center ;width: 100%;">
                            <i  class="fa fa-whatsapp fa-2x" aria-hidden="true" style="margin-right: 5px;color: green"></i><strong> 3321694362</strong>
                        </div>
            </div>

        </header>
        @yield('menu')
        @yield('slider')
        <div class="container">

            @yield('content')

        </div>
    </div>

    @include('layouts.footer')
