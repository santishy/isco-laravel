@extends('layouts.header')
@include('menus.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="container-article">
                    <div class="article-image">
                        @php
                            $img=@fopen("http://www.pchmayoreo.com/media/catalog/product/".substr($article->sku, 0,1)."/".substr($article->sku, 1,1)."/".$article->sku.".jpg",'r');
                            // $local=@fopen('http://iscocomputadoras.com/storage/images/imgsPCH/'.$article->sku.'.'.$,'r');
                        @endphp
                        @if($img)
                            <img class="img-responsive" onerror="this.onerror=null;this.src='{{ asset('images/noimg.jpg') }}'" src="http://www.pchmayoreo.com/media/catalog/product/{{substr($article->sku, 0,1)}}/{{substr($article->sku, 1,1)}}/{{$article->sku}}.jpg">
                            @php
                                @fclose($img);
                                // @fclose($local);
                            @endphp
                        @else
                            <img class="img-responsive" onerror="this.onerror=null;this.src='{{ asset('images/noimg.jpg') }}'" src="http://iscocomputadoras.com/storage/images/imgsPCH/{{$article->sku.'.'.$article->extension}}">
                        @endif
                    </div>
                    <div class="add-article">
                        <table class="table table-striped">
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
                                {{-- @for($i=0;$i < count($article->inventario()->get());$i++)
                                    <tr>
                                        <td>{{$almacenes[$article->inventario[$i]->almacen]}}</td>
                                        <td>{{$article->inventario[$i]->existencia}}</td>
                                        <td>
                                            <div class="radio radio-primary">
                                              <label>
                                                <input type="radio" name="almacen"  value="{{$article->inventario[$i]->almacen}}" data-existencia="{{$article->inventario[$i]->existencia}}">
                                              </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor --}}
                            </tbody>
                        </table>
                    </div><!--add-article-->
                    <div class="article-description">
                        <h2>Descripcion</h2>
                        <p>{{$article->descripcion}}</p>
                        <p>${{$price}}</p>
                        <form id="form-add-product" action="{{url('/in_shopping_carts')}}" method="post">
                            <div class="form-group">
                              <label for="cantidad" class="control-label">Cantidad:</label>
                                <input type="hidden" name="id_articulo" value="{{$id_articulo}}">
                                <input type="hidden" name="price" value="{{$price}}">
                                <input type="hidden" name="almacen" id="almacen"value="">
                                <input type="hidden" name="existencia" id="existencia">
                                <input type="number" class="form-control" name="qty" id="cantidad" placeholder="Ejemplo: 1">
                            </div>
                           <btn-add-to-cart></btn-add-to-cart>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
