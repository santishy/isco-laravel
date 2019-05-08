@extends('layouts.header')
@include('menus.main')
@section('content')
    <div class="container">
        <div class="row">
            @include('articles.products')
            @include('layouts.sidebar',['series',@series,'name',@name])
        </div>
    </div>
@endsection
