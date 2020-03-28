@extends('layouts.header')
@include('menus.main')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="card border-0 shadow-sm mt-3">
					<div class="card-body ">
						<div class="well top-space">
							<h3>Resumen de tu carrito de compras.</h3>
							<div class="row top-space">
								<div class="col-md-4 col-xs-4 col-lg-4 sale-data">
									<span>{{number_format($shopping_cart->total(),2)}} MXN</span>
									Subtotal
								</div>
								<div class="col-md-4 col-xs-4 col-lg-4 sale-data">
									<span>{{number_format($envio,2)}} MXN</span>
									Envío
								</div>
								<div class="col-md-4 col-xs-4 col-lg-4 sale-data" style="border:none">
									<span>{{number_format($shopping_cart->total()+$envio,2)}} MXN</span>
									Total
								</div>
							</div>

							<table class="table table-striped text-center">
								<thead>
									<th>Articulo</th>
									<th>Precio</th>
									<th>cantidad</th>
								</thead>
								<tbody>
									@foreach($products as $product)
										<tr>
											<td>{{$product->descripcion}}</td>
											<td>{{$product->precio}}</td>
											<td>
												<a href="#"
													data-type="number"
													data-pk="{{$product->in_shopping_cart_id}}"
													data-url='{{url("in_shopping_carts/$product->in_shopping_cart_id")}}'
													data-value="{{$product->qty}}"
													data-name="qty"
													class="set-qty"
													data-tile="Cantidad">
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>


			</div>
			<div class="col-md-3 mt-3">
				<form  action="{{route('pagar')}}" method="get">
					<div class="form-group">
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-outline-secondary rounded m-2 p-1">
								<input type="radio" name="payment_platform" value="paypal" required>
								<img src="{{asset('images/paypal.jpg')}}" class="img-thumnail"  alt="">
							</label>
							<label class="btn btn-outline-secondary rounded m-2 p-1">
								<input type="radio" name="payment_platform" value="mercadopago" required>
								<img src="{{asset('images/mercadopago.jpg')}}" class="img-thumnail"  alt="">
							</label>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-lg btn-block">Pagar</button>
					</div>
				</form>
			<a href="{{url('pagar')}}"><i style="font-size: 5em;" class="fab fa-cc-paypal"></i></a>
			{{-- 	@include('cards.card_pago',['ruta'=>url("/pagar"),'shopping_cart'=>$shopping_cart,
						'forma_pago'=>'paypal','fileName'=>'paypal.png','form_id'=>'form']) --}}
			{{-- 	@include('cards.card_pago',['ruta'=>url("/pagos"),'shopping_cart'=>$shopping_cart,
				'forma_pago'=>'credit_card','fileName'=>'credito.png','form_id'=>'formCardPago']) --}}
			</div>

		</div>
	</div>
	@include('modals.modal',['title'=>'Datos de compra','ruta'=>url('/pagos'),'bodyModal'=>'forms.credit_card','form_id'=>'formCreditCard'])
@endsection
