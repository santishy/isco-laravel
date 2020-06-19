<template>
  <div id="matching-products"  class="matching-products  shadow rounded py-0">
  <div class="d-flex align-items-center">
    <div v-if="searching" class="loader">
    </div>
  </div>

    <div v-for="product in matchingProducts" class="card border-top-0 border-left-0 border-right-0 matchingProductHover">
      <div class="row no-gutters">
        <div class="col-md-4 px-0 py-0">
          	<img loading="lazy" class="img-fluid product-image"  :src="product.url_img" @error="onerror(product)">
        </div>
        <div class="col-md-8">
          <div class="card-body ">
            <a :href="product.vinculo" style="font-size:0.9em" class="text-decoration-none matchingProductHover text-primary px-0 py-0">
              <p class="mb-2 font-weight-bolder">{{product.skuManufacturer}}</p>
              <p class="card-text mb-1">{{product.description}}</p>
              <p class="card-text text-danger font-weight-bold my-0">${{product.humanPrice}}</p>
              <!-- <p class="card-text">{{price_human}}</p> -->
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState} from 'vuex';
import {mapMutations} from 'vuex';
export default {
  data(){
    return{
        failedImageCount:0,
    }
  },
  created(){

    // document.addEventListener('click',(event)=>{
    //   let element = document.getElementById('matching-products');
    //   if(!(element == event.target || element.contains(event.target))){
    //     this.closeSearch();
    //   }
    //
    // })
  },
  methods:{
    ...mapMutations(['setMatchingProducts']),
    onerror(product){
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
    closeSearch(){
      this.setMatchingProducts([]);

    }
  },
  computed:{
    ...mapState(['matchingProducts','searching'])
  }
}
</script>

<style lang="css" scoped>
</style>
