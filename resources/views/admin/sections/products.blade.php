@extends('layouts.app')
@section('content')
  <dashboard-products-component url="/section-products/{{$id}}" section="{{$id}}" />
@endsection
