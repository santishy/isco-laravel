@push('styles')

@endpush

<label class="mt-3">Details Card</label>
<div class="form-group form-row">
  <div class="col-12">
    <input type="text" name="name" class="form-control" data-checkout="cardholderName" placeholder="Name">
  </div>
</div>
<div class="form-group form-row">
  <div class="col-12">
    <input type="email" name="email" class="form-control" data-checkout="cardholderEmail" placeholder="email@example.com">
  </div>
</div>
<div class="form-group form-row">
  <div class="col-12">
    <input type="text" id="cardNumber" placeholder="Card Number" class="form-control" data-checkout="cardNumber" l>
  </div>
</div>
<div class="form-group form-row ">
  <div class="col-4">
    <input type="text"  data-checkout="securityCode" class="form-control" placeholder="CVC">
  </div>
  <div class="col-4">
    <input type="text" class="form-control" id="cardExpirationMonth" data-checkout="cardExpirationMonth" placeholder="MM">
  </div>
  <div class="col-4">
    <input type="text" class="form-control" placeholder="YY" data-checkout="cardExpirationYear">
  </div>
</div>

{{-- <div class="form-gropu form-row">
  <div class="col-2">
    <select class="custom-select" data-checkout="docType">
    </select>
  </div>
  <div class="col-3">
    <input type="text" class="form-control" data-checkout="docNumber" placeholder="Document">
  </div>
</div> --}}
<div class="form-group form-row">
  <small class="form-text text-mute">Your payment will be converted to MXN</small>
</div>
<div class="form-group form-row">
  <small class="form-text text-danger" id="paymentErros" role="alert"></small>
</div>
<input type="hidden" name="paymentMethodId" id="paymentMethodId" value="">
<input type="hidden" name="cardToken" id="cardToken" value="">
<input type="hidden" name="value" value="{{$shopping_cart->total()}}">
<input type="hidden" name="currency" value="mxn">
@push('scripts')
  <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

  <script>
    window.Mercadopago.setPublishableKey("{{config("services.mercadopago.key")}}");
    function getBin(){
      const bin = document.getElementById('cardNumber')
      return bin.value.substring(0,6);;
    }
     function setCardNetwork(){
      window.Mercadopago.getPaymentMethod({
        'bin':getBin()
      },setPaymentMethodInfo)
    }
    function setPaymentMethodInfo(status,response){
      if(status == 200){
        const paymentMethodId = document.getElementById('paymentMethodId');
        paymentMethodId.value = response[0].id;
        mercadopagoForm.submit();
      }
    }
  </script>
  <script>

    const mercadopagoForm = document.getElementById('paymentForm');
    mercadopagoForm.addEventListener('submit',doPay);

    function doPay(event){
      if(mercadopagoForm.elements.payment_platform.value === "mercadopago" ){
        event.preventDefault();
        window.Mercadopago.createToken(mercadopagoForm,sdkResponseHandler);
      }
    }
    function sdkResponseHandler(status,response){
      if(status != 200 && status != 201){
          const error = document.getElementById('paymentErros');
          error.textContent = response.cause[0].description;
      }else{

        cardToken = document.getElementById('cardToken');
        cardToken.value = response.id;

        setCardNetwork();
      }
    }
  </script>

@endpush