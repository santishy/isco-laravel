@extends('layouts.header')
@include('menus.main')
@section('content')
	<div class="container  ">
		<div class="row">
			<div class="col-md-6 margin-top-2" style="margin-bottom: 2em;">
				<div class="card">
				  <div class="card-body">
				    <h3 class="card-title">Datos de Envío</h3>
					{!! Form::Open(['method'=>'POST', 'url' => 'orders']) !!}
						<div class="form-group">
							<label>Domicilio</label>
							<input type="text" name="line1" class="form-control" placeholder="Calle #numero">
						</div>
						<div class="form-group">
							<label>Referencia</label>
							<input type="text" name="line2" class="form-control" placeholder="Calle">
						</div>
						<div class="form-group">
							<label>Estado</label>
							<input type="text" name="state" class="form-control">
						</div>
						<div class="form-group">
							<label>Ciudad</label>
							<input type="text" name="city" class="form-control">
						</div>
						<div class="form-group">
							<label>Codigo Postal</label>
							<input type="text" name="postal_code" class="form-control">
						</div>
						<div class="form-group">
							<label>La persona dirigida</label>
							<input type="text" name="recipient_name" class="form-control">
						</div>
						<div class="form-group">
							<button class="btn btn-primary">Guardar</button>
						</div>
					{!! Form::close() !!}
				  </div>
				</div>

				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
			</div>
			<div class="col-md-6 margin-top-2">
				<h3 style="font-family: 'Bellefair', serif;"><i aria-hidden="true" class="fa fa-shopping-cart fa-1x"></i>  Productos agregados al carrito</h3>
				<hr>
				<cart-component ruta="{{url('carrito/productos')}}">
				</cart-component>
			</div>
		</div>
	</div>
@endsection
