@extends('layouts.header')
@include('menus.main')
@section('content')
    <div class="container">
        <search-items-component ruta="{{$ruta}}" ></search-items-component>
    </div>
@endsection
