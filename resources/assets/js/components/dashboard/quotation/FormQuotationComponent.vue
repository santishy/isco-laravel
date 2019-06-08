<template>
  <form id="form-quotation" @submit.prevent="quote">
    <div class="form-group row">
      <label for="ut" class="col-form-label col-sm-3 text-center">Utilidad</label>
      <div class="col-sm-9">
        <input type="number" id="ut" class="form-control" name="ut" :value="product.utilidade">
      </div>
    </div>
    <div class="form-group row">
      <label for="qty" class="col-sm-3 text-center">Cantidad</label>
      <div class="col-sm-9">
        <input type="number" name="qty"  class="form-control">
        <input type="hidden" name="existencia" :value="product.existence">
        <input type="hidden" name="id_articulo" :value="product.id">
      </div>

    </div>
    <div class="form-group row">
      <label for="price" class="col-sm-3 text-center">Precio</label>
      <div class="col-sm-9">
        <input type="number" id="price" name="price" class="form-control" :value="product.price">
      </div>
    </div>
    <div class="form-group text-center row justify-content-end">
      <div class="col-sm-9">
        <button type="submit" class="btn btn-outline-secondary btn-block" name="button">Cotizar</button>
      </div>
      </div>
  </form>
</template>

<script>
import {mapMutations} from 'vuex';
export default {
  props:['product'],
  methods:{
    quote(){
      const formData = new FormData(document.getElementById('form-quotation'))
      axios({
        url:'/in_shopping_carts',
        method:'POST',
        data:formData
      }).then((response)=>{
        if(response.data.success){
          return this.increment();
        }
        return alert('La cantidad supera las existencias')
      }).catch((error)=>{
        console.log(error)
      })
    },
    ...mapMutations(['increment'])
  }
}
</script>
