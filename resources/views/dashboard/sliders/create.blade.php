@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				{!! Form::open(['url'=>url('/slider'),'method'=>'post','files'=>true]) !!}
				{{-- <form action="{{ url('/slider') }}" method="post" enctype="multipart/form-date"> --}}
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" placeholder="Ejemplo: Camaras" name="name">
					</div>
					<div class="form-group">
						<label>Enlace</label>
						<input type="text" name="link" class="form-control" >
					</div>
					<div class="form-group">
						<label>Subir Imagen</label>
						<input type="file" name="slider" class="form-control">
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Enviar</button>
					</div>
				{{-- </form> --}}
				{!! Form::close() !!}
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