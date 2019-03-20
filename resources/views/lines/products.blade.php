@extends('layouts.header')
@include('menus.main')
@section('content')
<div class="container">
    <div class="row">
        @include('articles.products',['products'=>$products])
    </div>
</div>
@endsection