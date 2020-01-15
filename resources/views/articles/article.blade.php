@extends('layouts.header')
@include('menus.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card my-3 border-0 shadow-sm">
                <div class="row no-gutters">
                  <div class="col-md-5">
                    @php
                        $img=@fopen("http://www.pchmayoreo.com/media/catalog/product/".substr($article->sku, 0,1)."/".substr($article->sku, 1,1)."/".$article->sku.".jpg",'r');
                        // $local=@fopen('http://iscocomputadoras.com/storage/images/imgsPCH/'.$article->sku.'.'.$,'r');
                    @endphp
                    @if($img)
                        <img class="img-fluid" onerror="this.onerror=null;this.src='{{ asset('images/noimg.jpg') }}'" src="http://www.pchmayoreo.com/media/catalog/product/{{substr($article->sku, 0,1)}}/{{substr($article->sku, 1,1)}}/{{$article->sku}}.jpg">
                        @php
                            @fclose($img);
                            // @fclose($local);
                        @endphp
                    @else
                        <img class="img-fluid" onerror="this.onerror=null;this.src='{{ asset('images/noimg.jpg') }}'" src="http://iscocomputadoras.com/storage/images/imgsPCH/{{$article->sku.'.'.$article->extension}}">
                    @endif
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                      <h5 class="card-title">SKU:{{$article->skuFabricante}}</h5>
                      <p class="card-text">{{strtoupper($article->descripcion)}}</p>
                      <ul class="text-muted">
                        <li>LINEA : {{$article->line->linea}}</li>
                        <li>SERIE: {{$article->serie->name}}</li>
                      </ul>
                      <p class="card-text">Medidas</p>
                      <table class="table table-responsive-sm text-center">
                        <thead>
                          <tr>
                            <th>Largo</th>
                            <th>Ancho</th>
                            <th>Peso</th>
                            <th>Alto</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{$article->largo}}<small> mm</small></td>
                            <td>{{$article->ancho}}<small> mm</small></td>
                            <td>{{$article->peso}}<small> g</small></td>
                            <td>{{$article->alto}}<small> mm</small></td>
                          </tr>
                        </tbody>

                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-3 ml-2">
              <div class="card shadow-sm boerder-0 my-3">
                  <div class="card-body">
                      <div class="text-secundary">
                        Elige tú lugar más cercano
                      </div>
                      <table class="table table-striped table-responsive">
                          <thead>
                              <th>Amacen</th>
                              <th>Stock</th>
                              <th>Opción</th>
                          </thead>
                          <tbody>
                            @foreach ($article->inventario()->get() as $inventario)

                                <tr>
                                    <td>{{$almacenes[$inventario->almacen]}}</td>
                                    <td>{{$inventario->pivot->existencia}}</td>
                                    <td>
                                        <div class="radio radio-primary">
                                          <label>
                                            <input type="radio" name="almacen"  value="{{$inventario->almacen}}" data-existencia="{{$inventario->pivot->existencia}}">
                                          </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                          </tbody>
                      </table>

                      <form id="form-add-product" action="{{url('/in_shopping_carts')}}" method="post">
                          <div class="form-group">
                            <label for="cantidad" class="control-label">Cantidad:</label>
                              <input type="hidden" name="id_articulo" value="{{$id_articulo}}">
                              <input type="hidden" name="price" value="{{$price}}">
                              <input type="hidden" name="almacen" id="almacen"value="">
                              <input type="hidden" name="existencia" id="existencia">
                              <input type="number" class="form-control" name="qty" id="cantidad" placeholder="Ejemplo: 1">
                          </div>
                         <btn-add-to-cart/>
                      </form>
                  </div>
              </div>
            </div>
        </div>
    </div>
@endsection
