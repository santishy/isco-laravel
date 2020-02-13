@extends('layouts.app')
@section('content')
  <dashboard-products-component url="/brand-products/{{$id}}" section="{{$id}}" />
@endsection
