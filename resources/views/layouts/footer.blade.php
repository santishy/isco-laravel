<footer class="footer">
  <div class="div-menu-footer">
    <ul class="menu-footer col-md-2 ">
      <li class="title-menu">LINEAS</li>
      @foreach($vars['lines']->get() as $line)
        <li><a href="{{ url('lineas/'.$line->id_linea) }}">{{ $line->linea }}</a></li>
      @endforeach
      <li ><a class="menu-list" data-type="lines" href="#">Ver todas...</a></li>
    </ul>
    <ul class="menu-footer col-md-2">
      <li class="title-menu">PRODUCTOS</li>
      @foreach($vars['products']->get() as $seccion)
        <li><a href="{{url('/productos/'.$seccion->id_seccion)}}">{{$seccion->seccion}}</a></li>
      @endforeach
      <li ><a class="menu-list" data-type="products" href="#">Ver todas...</a></li>
    </ul>
    <div class="branch-offices col-md-6">
      <p class="title-menu">Sucursales</p>
      <p>Contamos con varias sucursales en diferentes partes del país, entregas más rapidas y ahora podras recoger
         tus productos en cual quiera de nuestras sucursales.</p>
      <ul>
        <li>Guadalajara</li>
        <li>CDMX Aeropuerto</li>
        <li>León</li>
        <li>Monterrey</li>
        <li>Puebla</li>
        <li>Mérida</li>
      </ul>
      <div>
        <p>¿Necesitas ayuda?, llamanos y te atenderemos a la brevedad</p>
        <a href="tel:+5235327373"><span class="glyphicon glyphicon-earphone earphone"></span> 01 800 001 ISCO </a>
      </div>
    </div>
  </div>
  <div class="empresa">
    ISCO COMPUTADORAS SA DE CV
  </div>
</footer>
@include('modals.cart')
<!-- Scripts -->


    {{-- <script>
    $.material.init();
	  $.material.ripples();
	  $.material.input();
  	</script> --}}
  	{{-- <script>
  		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  	</script> --}}
	<script src="{{url('/js/app.js')}}"></script>
</body>
</html>
