@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Editar Utilidad</h5>
						{!! Form::Open(['method'=>'PUT','route'=>['utilities.update',$utility->id_utilidad]]) !!}
							<div class="form-group">
								<label for="seccion">Categoría</label>
								<select name="categoria" id="seccion" class="form-control">
									@foreach($vars['secciones'] as $section)
										<option class="form-control" value="{{$section->seccion}}"
											@if($section->seccion==$utility->categoria) {{'selected'}} @endif
											>{{$section->seccion}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>utilidad</label>
								<input type="number" name="ut" class="form-control">
							</div>
							<div class="form-group">
								<label> Desde</label>
								<input type="number" name="desde" class="form-control">
							</div>
							<div class="form-group">
								<label>Hasta</label>
								<input type="number" name="hasta" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Guardar Cambios</button>
							</div>
						{!! Form::Close()!!}
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
		</div>
	</div>
@endsection