@extends('layouts.header')
@include('menus.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
              <section-series-products-component method="{{$method}}" ruta="{{ $ruta }}"></section-series-products-component>
            </div>
            @include('layouts.sidebar',['series',@series,'name',@name])
        </div>
    </div>
@endsection
