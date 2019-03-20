@extends('layouts.header')
@include('menus.main')
@include('layouts.slider')
@section('content')
    <div class="row">
    	@include('slider.products',['articles'=>$articles,'slider_id'=>'sliderProducts','title'=>'Lo más visto'])
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('slider.brands',['slider_id'=>'sliderBrands'])
        </div>
    </div>
    <div class="row">
        @include('slider.products',['articles'=>$articles,'slider_id'=>'sliderOferts','title'=>'Ofertas rapidas'])
    </div>
@endsection
