@section('menu')
<div class="icon-menu-fa">
    <i class="fas fa-bars"></i>
</div>
<div style="z-index:100 !important"  id="container-menu" class="container-menu sticky-top">
    <a id="viewShoppingCart" href="{{url('pagos/'.$shopping_cart->id)}}"class="viewShoppingCart">
        <span class="badge">{{$shopping_cart->articulos()->count()}}</span>
        <i class="fa fa-shopping-cart fa-1x" aria-hidden="true"></i>
    </a>

    <nav  class="menu">
        <ul style="z-index:100 !important;">
            <li class="col-md-5 search-component text-center">
              <search-component></search-component>
              <matching-products class="mt-2"></matching-products>
            </li>
            <li><a href="http://{{url('/')}}">Inicio</a></li>
            <li>
                <a href="#" class="submenu">Productos <SPAN class="glyphicon glyphicon-chevron-down"></SPAN></a>
                <ul>
                    <li class="atras">Menú Principal</li>
                    @foreach($vars['secciones'] as $seccion)
                        <li><a href="{{url('/productos/'.$seccion->id_seccion)}}">{{$seccion->seccion}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#" class="submenu">Marcas <SPAN class="glyphicon glyphicon-chevron-down"></SPAN></a>
                <ul>
                    <li class="atras">Menú Principal</li>
                    @foreach($vars['marcas'] as $marca)
                        <li><a href="{{ url('/marca/'.$marca->id_marca) }}">{{$marca->marca}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="#">Contacto</a></li>
            <li>
              <counter-products-component :count="{{$shopping_cart->articulos()->count()}}"></counter-products-component>
            </li>
        </ul>
    </nav>
</div>
@endsection
