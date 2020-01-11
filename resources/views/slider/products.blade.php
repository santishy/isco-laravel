<div class="col-md-12">
    <div class="header-slider">
        {{ $title }}
    </div>
    <div class="productsClicks">
    	<div class="inner-brand" id="{{ $slider_id }}">
    		@foreach ($articles as $article)
    			<div class="img-click">
    				<a href="{{ url('producto/'.$article->id_articulo) }}" class="link-product">
                        <img onerror="this.onerror=null;this.src='{{ asset('images/noimg.jpg') }}';" src="http://www.pchmayoreo.com/media/catalog/product/{{substr($article->sku, 0,1)}}/{{substr($article->sku, 1,1)}}/{{$article->sku}}.jpg">
	    				<div class="content-article">
	    						<p class="description">
	    							{{ $article->descripcion }}
	    						</p>
	    						<p class="price">
	    							${{ $article->numberFormat() }}
	    						</p>
	    				</div>
    				</a>
    			</div>
    		@endforeach
    	</div>
        <a href="#" class="btnRight"><span class=" glyphicon glyphicon-chevron-right"></span></a>
        <a href="#" class="btnLeft"><span class=" glyphicon glyphicon-chevron-left"></span></a>
    </div>
</div>
