<div class="col-md-3 ">
  <div class="sidebar border-0 shadow-sm" style="padding-top: 3em;height:200px;background:white">
        <div class="title-sidebar border-0">
          Lineas
        </div>
        @if($lines != null)
          @foreach($lines as $line)
             <a class="link-product "href="{{ url($url."linea/".$line->id_linea) }}">{{ $line->linea }}</a>
          @endforeach
          @endif
    </div>
    <div class="sidebar border-0 shadow-sm" style='margin-bottom: 10px;background:white'>
        <div class="title-sidebar border-0">
          Series
        </div>
        @if($series != null)
        <form id="frmSeries" action="{{ url($url.'series') }}" method="POST">
          <div class="form-group">
            {{ csrf_field() }}
            @php $i=0; @endphp
          @foreach($series as $serie)
             <div class="checkbox">
                <label>
                  <input name="serie_{{ $i }}" type="checkbox" class="checkbox_serie" value="{{ $serie->id}}" @php if(isset($array['serie_'.$i])) echo 'checked' @endphp> {{ $serie->name}}
                </label>
              </div>
              @php
                $i++;
              @endphp
          @endforeach
            </div>
          @endif
        </form>
    </div>
</div>
