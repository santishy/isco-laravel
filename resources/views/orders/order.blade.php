@extends('layouts.header')
@include('menus.main')
@section('content')
	<header class="big-padding text-center"><h1>Datos de la compra</h1></header>
	<div class="container">
		<div class="card large-padding">
			<h3>Pago <span>{{$shopping_cart->status}}</span></h3>
			<p class="alert alert-dismissible alert-info">Si alguno de estos datos no concuerda con tu información, puedes modificarlo aquí mismo.</p>
			<div class="row large-padding">
				<div class="col-xs-6">
					<label>Nombre</label>
				</div>
				<div class="col-xs-6">
					<a href="#"
						data-type="text" data-pk="{{$order->id}}"
						data-url='{{url("/orders/$order->id")}}'
						data-title="Nombre" 
						data-value="{{$order->recipient_name}}"
						class="set-recipient-name"
						data-name="recipient_name">{{$order->recipient_name}}</a>
				</div>
			</div>
			<div class="row large-padding">
				<div class="col-xs-6">
					<label>Correo</label>
				</div>
				<div class="col-xs-6">
					<a href="#"
						data-type="email" data-pk="{{$order->id}}"
						data-url='{{url("/orders/$order->id")}}'
						data-title="Correo" 
						data-value="{{$order->email}}"
						class="set-email"
						data-name="email"></a>
				</div>
			</div>
			<div class="row large-padding">
				<div class="col-xs-6">
					<label>Domicilio</label>
				</div>
				<div class="col-xs-6">
					<a href="#"
						data-type="text" data-pk="{{$order->id}}"
						data-url='{{url("/orders/$order->id")}}'
						data-title="Dirección" 
						data-value="{{$order->address()}}"
						class="set-address"
						data-name="line1"></a>
				</div>
			</div>
			<div class="row large-padding">
				<div class="col-xs-6">
					<label>Ciudad</label>
				</div>
				<div class="col-xs-6">
					<a href="#"
						data-type="text" data-pk="{{$order->id}}"
						data-url='{{url("/orders/$order->id")}}'
						data-title="Ciudad" 
						data-value="{{$order->city}}"
						class="set-city"
						data-name="city"></a>
				</div>
			</div>
			<div class="row large-padding">
				<div class="col-xs-6">
					<label>Estado</label>
				</div>
				<div class="col-xs-6">
					<a href="#"
						data-type="text" data-pk="{{$order->id}}"
						data-url='{{url("/orders/$order->id")}}'
						data-title="Estado" 
						data-value="{{$order->state}}"
						class="set-state"
						data-name="state"></a>
				</div>
			</div>
			<div class="row large-padding">
				<div class="col-xs-6">
					Nom. Guía
				</div>
				<div class="col-xs-6">
					{{$order->guide_number}}
				</div>
			</div>
			<div class="text-center top-space">
				<a href="{{url('compras/'.$shopping_cart->customid)}}">Link permanente de tu compra</a>
			</div>
		</div>
	</div>
@endsection