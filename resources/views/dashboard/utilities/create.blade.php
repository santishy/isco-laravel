
				<div class="panel panel-primary">
				  	<div class="panel-heading">Nueva Utilidad (Por Seccion)</div>
				  	<div class="panel-body">
				    	{!! Form::open(["url"=>"/utilities"]) !!}
				    		<div class="form-group">
				    			<label>Categoría</label>
				    			<select class="form-control" name="categoria">
				    				@foreach($vars["secciones"] as $section)
				    					<option value="{{ $section->seccion }}">{{ $section->seccion }}</option>
				    				@endforeach
				    			</select>
				    		</div>
				    		<div class="form-group">
				    			<label>Desde</label>
				    			<input type="number" name="desde" class="form-control">
				    		</div>
				    		<div class="form-group">
				    			<label>Hasta</label>
				    			<input type="number" name="hasta" class="form-control">
				    		</div>
				    		<div class="form-group">
				    			<label>Utilidad</label>
				    			<input type="number" name="ut" class="form-control">
				    		</div>
				    		<div class="form-group">
				    			<input type="submit" class="btn btn-success" name="">
				    		</div>
				    	{!! Form::close() !!}
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
		