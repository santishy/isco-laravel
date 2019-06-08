@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-md-5 col-12  ">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Agregar Producto</h5>
				    <p class="card-text">
				    	{!! Form::Open(['url'=>'products', 'method'=>'POST','files'=>true])!!}
				    		<div class="form-group">
				    			<label for="image">Imagen</label>
				    			<input type="file" id="image" name="image" class="form-control">
				    		</div>
				    		<div class="form-group">
				    			<label>Descripción</label>
				    			<textarea class="form-control" name="descripcion" id="descripcion">
				    			</textarea>
				    		</div>
				    		<div class="form-group">
				    			<label for="skuFabricante">Sku Fabricante</label>
				    			<input type="text" name="skuFabricante" class="form-control" id="skuFabricante">
				    		</div>
				    		<div class="form-group">
				    			<label>Sku (interno)</label>
				    			<input type="text" name="sku" id="sku" class="form-control">
				    		</div>
				    		<div class="form-group">
				    			<label for="proveedor">Proveedor</label>
				    			<input type="text" id="proveedor" name="proveedor" class="form-control">
				    		</div>
				    		<div class="form-group">
				    			<label for="id_marca">Marca</label>
				    			<select class="form-control" name="id_marca" id="id_marca">
				    				@foreach($vars['marcas'] as $marca)
				    					<option value="{{$marca->id_marca}}">{{$marca->marca}}</option>
				    				@endforeach
				    			</select>
				    		</div>
				    		<div class="form-group">
				    			<label for="id_seccion">Seccion</label>
				    			<select class="form-control" id="id_seccion" name="id_seccion">
				    				@foreach($vars['secciones'] as $seccion)
				    					<option value="{{$seccion->id_seccion}}">{{$seccion->seccion}}</option>
				    				@endforeach
				    			</select>
				    		</div>
				    		<div class="form-group">
				    			<label for="id_linea">Linea</label>
				    			<select class="form-control" name="id_linea">
				    				@foreach($vars['lineas'] as $linea)
				    					<option value="{{$linea->id_linea}}">{{$linea->linea}}</option>
				    				@endforeach
				    			</select>
				    		</div>
				    		<div class="form-group">
				    			<label for="moneda">Moneda</label>
				    			<select class="form-control" name="moneda" id="moneda">
				    				<option value="MN">MN</option>
				    				<option value="USD">USD</option>
				    			</select>
				    		</div>
				    		<div class="form-group">
				    			<label for="serie">Serie</label>
				    			<select class="form-control" name="id_serie">
				    				@foreach($vars['series'] as $serie)
				    					<option value="{{$serie->id}}">{{$serie->name}}</option>
				    				@endforeach
				    			</select>
				    		</div>
				    		<div class="form-group">
				    			<label for="precio">Precio</label>
				    			<input id="precio" type="number" name="precio" class="form-control">
				    		</div>
				    		<div class="form-group">
				    			<label>Existencia</label>
				    			<input type="number" name="existencia" value="" class="form-control">
				    		</div>
				    		<div class="form-group">
				    			 <button type="submit" class="btn btn-primary">Agregar producto</button>
				    		</div>
				    	{!! Form::close() !!}
				    </p>

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
		</div>
	</div>

@endsection
