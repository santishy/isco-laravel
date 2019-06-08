<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles -->
        <style>
          .table {
              width: 100%;
              margin-bottom: 1rem;
              background-color: transparent;
            }
             tbody tr:nth-of-type(odd) {
                  background: green !important;
              }
            .table {
                display: table;
                border-collapse: separate;
                border-spacing: 2px;
                border-color: grey;
            }
          .img-responsive{
            width: 100%;
            height: auto;
          }
          .container{
            width: 80%;
            margin-right: 10%;
          }
          .text-center{
            text-align: center;
          }
          tbody {
              display: table-row-group;
              /* vertical-align: middle; */
              border-color: inherit;
          }
          tr{
              display: table-row;
              vertical-align: inherit;
              border-color: inherit;
              padding: 2em;
              border-bottom:2px solid #a6a6a6;
          }
          th{
            padding: 1em;
          }
          td, th{
              display: table-cell;
              vertical-align: text-top;
          }
          thead{
            background: #0077b3;
            color:white;
            font-weight: bold;
          }
        </style>
    </head>

  </head>
  <body>
    <header>
      <div width="30px" class="img-responsive">
        <img src="{{asset('images/logo.png')}}" alt="">
      </div>
    </header>
    <div class="container">
      <h3 class="text-center">Cotización</h3>
      {{-- <h4>{{$data->shopping_cart->cliente}} :) </h4> --}}
      <p>Hemos recibido su cotización le enviamos los detalles por este medio y en un archivo adjunto a este correo
      en formato pdf</p>
      <hr>
      <table class="table text-center">
        <thead>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>subtotal</th>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($shopping_cart->BelongsToManyArticulos()->get() as $producto)
            <tr style="border-bottom:1px solid black;@if($i%2 == 0) {{'background:#e6e6e6'}} @endif">
              <td>
                {{$producto->descripcion}}
              </td>
              <td>
                {{$producto->price}}
              </td>
              <td>
                {{$producto->qty}}
              </td>
              <td>
                {{($producto->precio*$producto->qty)}}
              </td>
            </tr>
            @php $i++; @endphp
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>
