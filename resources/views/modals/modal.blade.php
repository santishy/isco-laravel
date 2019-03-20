<div class="modal" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">{{$title}}</h4>
      </div>
      <div class="modal-body">
        @include($bodyModal,['form_id'=>$form_id])
        <div id="alerta" class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <a href="javascript:void(0)" class="alert-link">que los datos de su tarjeta sean correctos y volver a enviar.</a>
        </div>
        <div id="spinner" class="spinner">
            <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="btnModal" type="button" data-form="{{$form_id}}" data-ruta="{{$ruta}}" class="btn btn-primary">Listo</button>
      </div>
    </div>
  </div>
</div>
