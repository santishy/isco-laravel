<!DOCTYPE html>
<html>
<head>
	<title>Cotización</title>
	<style>
		h3,h4{
			margin: 0px;
		}
		.center{
			text-align: center;
		}
		.table{
			width: 100%;
		}
		th,td{
			border-bottom: 1px solid #ddd;
			text-align: center;
		}
		.text-right{
			text-align: right;
		}
		.img-responsive{
			width: 80px;
			height: auto;
		}
		.logotipo{
			width: 100%;
		}
		.inline-block{
			margin-left: -4px;
			display: inline-block;
			width: 50%;
		}
		.title{
			margin-top: 40px;
			font-family: sans-serif;
			color: #0086b3;
			font-weight: bold;
			font-size: 2em;
		}
	</style>

	<!-- Latest compiled and minified CSS -->
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
</head>
<body>
	<header>
		<div class="inline-block" style="width:30%;position: absolute;">
			<img class="logotipo" src="images/logotipo.jpg">
		</div>
		<div class="inline-block" style="width:100%">
			<h3 class="center">Isco Computadoras S.A. de C.V.</h4>
			<h4 class="center">Tel 01 800 ISCO </h4>
		</div>
		<div class="inline-block center" style="width:auto;right:  10px;font-weight:.8em;position: absolute;">
			<strong>{{ $fecha }}</strong>
		</div>
	</header>
	<h3 class="text-right title">Cotización</h3>
	{{-- @if($shopping_cart->cliente) --}}
		<h4><strong>Cliente</strong></h4>
		<h4>@php
			if(isset($name))
				echo $name;
		@endphp</h4>
		<hr>
	{{-- @endif --}}
	<table class="table">
		<thead>
			<tr>
				<th>Imagen</th>
				<th>Articulo</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Imp.</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($shopping_cart->belongsToManyArticulos()->get() as $product)
				<tr class="flex-table">

					<td>
						@php
							$img=@fopen("http://www.pchmayoreo.com/media/catalog/product/".substr($product->sku, 0,1)."/".substr($product->sku, 1,1)."/".$product->sku.".jpg",'r');
							// $local=@fopen('http://iscocomputadoras.com/storage/images/imgsPCH/'.$product->sku.'.'.$,'r');
						@endphp
						@if($img)
							<img class="img-responsive" onerror="this.onerror=null;this.src='{{ asset('images/noimg.jpg') }}'" src="http://www.pchmayoreo.com/media/catalog/product/{{substr($product->sku, 0,1)}}/{{substr($product->sku, 1,1)}}/{{$product->sku}}.jpg">
							@php
								@fclose($img);
								// @fclose($local);
							@endphp
						@else
							<img class="img-responsive" onerror="this.onerror=null;this.src='{{ asset('images/noimg.jpg') }}'" src="http://iscocomputadoras.com/storage/images/imgsPCH/{{$product->sku.'.'.$product->extension}}">
						@endif
						{{-- <img onerror="this.onerror=null;this.src='images/noimg.jpg';" class="img-responsive" src="http://www.pchmayoreo.com/media/catalog/product/{{substr($product->sku, 0,1)}}/{{substr($product->sku, 1,1)}}/{{$product->sku}}.jpg"> --}}
					</td>
					<td>
						{{ $product->descripcion }}
					</td>
					<td>
						{{ $product->qty }}
					</td>

					<td>
						${{ $product->price }}
					</td>
					<td>${{$product->price*$product->qty}}</td>

				</tr>
			@endforeach
				<tr>
					<td colspan="4" style="text-align: right;">
						<strong style="font-size: 1.2em">Total</strong>
					</td>
					<td style="font-size: 1.2em">
						${{ $shopping_cart->total() }}
					</td>
				</tr>
		</tbody>
	</table>
</body>
</html>
