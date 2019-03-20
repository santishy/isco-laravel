@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			@include('dashboard.utilities.create')
		</div>
		<div class="col-md-8">
		{!! Form::Open(['url'=>'utilities/filtro','method'=>'GET']) !!}
			<div class="form-group">
				<input type="text" name="categoria" placeholder="Buscar por categoría" class="form-control">
			</div>
		{!! Form::close() !!}
		<div class="table-response">
			<table class="table table-striped">
				<thead>
					<th>ID</th>
					<th>Categoría</th>
					<th>Desde</th>
					<th>Hasta</th>
					<th>Utilidad</th>
					<th>Acciones</th>
				</thead>
				<tbody>
					@foreach($utilities as $utility)
						<tr class="text-center">
							<td>{{$utility->id_utilidad}}</td>
							<td>{{$utility->categoria}}</td>
							<td>{{$utility->desde}}</td>
							<td>{{$utility->hasta}}</td>
							<td>{{$utility->ut}}</td>
							<td>
								<button class="btn btn-danger btn-xs btn_borrar_utilidad" data-id="{{$utility->id_utilidad}}"><i class="fas fa-trash-alt"></i></button>
								<a class="btn btn-primary" href="{{ route('utilities.edit',$utility->id_utilidad) }}"><i class="fas fa-edit"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="container">
			{{$utilities->links()}}
		</div>
	</div>
	</div>
</div>

@endsection