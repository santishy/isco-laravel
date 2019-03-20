<div class="modal" id="modalCart">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Carrito de compras</h4>
      </div>
      <div class="modal-body">
      </div>
      <table class="table table-striped table-hover">
          <thead>
              <th>IMG</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Quitar</th>
          </thead>
          <tbody id="tbody-cart" data-token="{{csrf_token()}}">
              @foreach($shopping_cart->BelongsToManyArticulos as $article)
                <tr class="tr-cart">
                    <td>
                        <img class="img-responsive" src="http://www.pchmayoreo.com/media/catalog/product/{{substr($article->sku, 0,1)}}/{{substr($article->sku, 1,1)}}/{{$article->sku}}.jpg" alt="">
                    </td>
                    <td>{{$article->descripcion}}</td>
                    <td>{{$article->qty}}</td>
                    <td>
                         {{ csrf_field() }}
                        <button  type="button" data-id="{{$article->inShoppingCartId()}}" class="btn btn-danger btn-xs suprInShoppingCart"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>
              @endforeach
          </tbody>
      </table>
      <div class="modal-footer">
        <a href="{{ url('cotizacion/') }}" class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        {{-- <a href="{{ url('pagos/'.Session::get("shopping_cart_id")) }}" id="btnPaymentCart"  class="btn btn-primary">Ir a pagar</a> --}} 
        {{-- IR A PAGAR AL CARRITO LINEA COMENTADA DE ARRIBA --}}
        <a href="{{route('orders.create')}}" class="btn btn-primary">Comprar</a>
      </div>
    </div>
  </div>
</div>
