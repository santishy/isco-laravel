@extends('layouts.header')
@include('menus.main')
@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Dashboard</h2>
			</div>
			<div class="panel-body">
				<h3>Estadisticas</h3>
				<div class="row top-space">
					<div class="col-xs-4 col-md-4 sale-data">
						<span>{{$totalMonth}}</span>
						Ingresos del mes
					</div>
					<div class="col-xs-4 col-md-4 sale-data">
						<span>{{$totalMonthCount}}</span>
						Número de ventas
					</div>
				</div>
				<h3>Ventas</h3>
				<table class="table table-striped">
					<thead>
						<th>Id Venta</th>
						<th>Comprador</th>
						<th>Dirección</th>
						<th>Nom. Guía</th>
						<th>Status</th>
						<th>Fecha Venta</th>
						<th>Acciones</th>
					</thead>
					<tbody>
						@foreach($orders as $order)
							<tr>
								<td>{{$order->id}}</td>
								<td>{{$order->recipient_name}}</td>
								<td>{{$order->address()}}</td>
								<td>
									<a href="#" 
										data-type="text" data-pk="{{$order->id}}"
										data-url='{{url("/orders/$order->id")}}'
										data-title="Número de Guía" 
										data-value="{{$order->guide_number}}"
										class="set-guide-number"
										data-name="guide_number"></a>
								</td>
								<td><a href="#" 
										data-type="select" data-pk="{{$order->id}}"
										data-url='{{url("/orders/$order->id")}}'
										data-title="Status" 
										data-value="{{$order->status}}"
										class="select-status"
										data-name="status">{{$order->status}}</a></td>
								<td>{{$order->created_at}}</td>
								<td></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
@endsection