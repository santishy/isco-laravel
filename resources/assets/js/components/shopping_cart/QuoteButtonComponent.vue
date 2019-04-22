<template>
  <div>
    <a :href="url" class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
    <b-button class="mt-2" variant="outline-warning" block @click="toggleModal">Toggle Me</b-button>
  </div>
</template>
<script>
export default {
  data(){
    return {
      url:'/cotizacion'
    }
  }
}
</script>
