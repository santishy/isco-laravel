<!--Card-->
<div class="card top-space">
	<div class="card-block">
		{!! Form::Open (["id"=>$form_id, "class"=>"inline-block", "method"=>"POST" ,"url"=>$ruta]) !!}
			<div class="form-group text-center top-space">
				<input name="forma_pago" value="{{$forma_pago}}" type="hidden">
				<input name="total" type="hidden" value="{{$shopping_cart->total()}}">
				 {{ csrf_field() }}
				<button   class="btn  btn-fab btn-primary formCardPag"><i class="material-icons">payment</i></button>
			</div>
		{!! Form::Close() !!}
	</div>
	<!--Card image-->
	<img class="img-responsive" src="{{asset('images/'.$fileName)}}" alt="Card image cap">
	<!--/.Card image-->
	<!--Card content-->
	<!--/.Card content-->
</div>
