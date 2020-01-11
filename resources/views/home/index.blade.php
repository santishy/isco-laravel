@extends('layouts.header')
@include('menus.main')
@include('layouts.slider')
@section('content')
    <div class="row">
    	@include('slider.products',['articles'=>$articles,'slider_id'=>'sliderProducts','title'=>'Lo más visto'])
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10>
            @include('slider.brands',['slider_id'=>'sliderBrands'])
        </div>
    </div>
    <div class="row">
        @include('slider.products',['articles'=>$articles,'slider_id'=>'sliderOferts','title'=>'Ofertas rapidas'])
    </div>
@endsection
