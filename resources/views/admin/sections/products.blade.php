@extends('layouts.app')
@section('content')
  <dashboard-products-component lines="{{$lines}}"
                                series="{{$series}}"
                                url="/section-products/{{$id}}"
                                section="{{$id}}"/>
@endsection
