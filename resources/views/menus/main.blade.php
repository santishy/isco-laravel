@section('menu')
<div class="icon-menu-fa">
    <img height="25"src="{{asset('images/menu.svg')}}">
</div>
<div id="container-menu" class="container-menu">
    <a id="viewShoppingCart" href="{{url('pagos/'.$shopping_cart->id)}}"class="viewShoppingCart">
        <span class="badge">{{$shopping_cart->articulos()->count()}}</span>
        <i class="fa fa-shopping-cart fa-1x" aria-hidden="true"></i>
    </a>
    <nav class="menu">
        <ul>
            <li><a href="http://iscocomputadoras.com">Inicio</a></li>
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

          @guest
                <li class="">
                    <a class="nav-link" href="{{ route('login') }}"> <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                </li>
                <li class="">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('REGISTRO') }}</a>
                </li>
            @else
                <li style="width:auto;" class="nav-item dropdown">
                    <a  id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ substr(Auth::user()->name,0,9) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a style="color:black" class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>
</div>
@endsection
