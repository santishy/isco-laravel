<template>
  <div class="row">
    <div class="col-md-12">
      <label for="encabezado-cotizacion">Encabezado de cotización</label>
      <textarea v-model="header" class="form-control" name="descripcion" id="encabezado-cotizacion"></textarea>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      header:''
    }
  },
  methods:{
    hola(){
      alert('hola mundo');
    }
  }
}
</script>
