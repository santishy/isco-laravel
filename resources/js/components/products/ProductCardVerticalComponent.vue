<template>
  <div class="d-flex flex-wrap  justify-content-center">
    <div v-for="product in products" class="card mr-2 border-0 shadow-sm bg-white rounded mb-2 relawey" style="width: 15rem;">
      <img loading="lazy" :src="product.url_img" class="card-img-top img-fluid" @error="onerror(product)" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{product.skuFabricante}}</h5>
        <p class="card-text">{{product.description}}</p>
      </div>
      <div style="background:#373759" class="card-footer border-0 px-0 py-0 text-center">
        <a href="" style="display:block;" class="text-white font-weight-bold text-decoration-none p-2">Ir a comprar</a>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return {
        products:[]
    }
  },
  mounted(){
    this.getProducts();
  },
  methods:{
    getProducts(){
      axios({
        url:'/home',
        method:'GET'
      }).then((response) => {
        if(response.data.length){
          this.products = response.data;
        }
        console.log(response.data)
      }).catch(error => {
        console.log(error)
      });
    },
    onerror(product){
      console.log(product)
      EventBus.$emit('imgLocal',this.$attrs['data-index'])
      if(product.unloadedImage){
        event.target.src = product.imgLocal;
        if(this.failedImageCount){
          event.target.src = product.noimg;
        }
        this.failedImageCount++;
      }
      else
        event.target.src = product.noimg;
    },
    noimg(event){
      event.target.src = product.noimg;

    },
  }
}
</script>

<style lang="css" scoped>
</style>
