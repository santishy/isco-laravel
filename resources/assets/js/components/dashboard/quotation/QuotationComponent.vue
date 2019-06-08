<template>
    <div class="container">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cotización</h5>
            <div class="row justify-content-center">
              <div class="col-sm-7">
                <form id="quotation-data" @submit.prevent="store">
                  <div class="form-group">
                    <label for="">Nombre del cliente</label>
                    <input type="text" class="form-control" name="name"  value="">
                  </div>
                  <div class="form-group">
                    <label for="">Correo</label>
                    <input type="email" name="email"  class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-secundary" name="button">Enviar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <cart-component :ruta="'/carrito/productos'">
  				</cart-component>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  methods:{
    store(){
      let quotationData = new FormData(document.querySelector('#quotation-data'))
      axios({
        method:'POST',
        url:'/quotations',
        data:quotationData
      }).then((response)=>{
        console.log(response.data)
      }).catch((error)=>{
        console.log(error)
      });
    }
  }
}
</script>
