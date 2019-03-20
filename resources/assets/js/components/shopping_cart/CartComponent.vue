<template lang="html">
  <table   class="table table-striped">
  <material-transition-component
  :css="false"
  name="fadeIn"
  tag="tbody"
  >
    <tr  class="tr-center":key="product.id" :data-index="index" v-for="(product,index) in products">
        <td width="100px" style="background:white">
          <img  class="img-responsive" :src="product.url_img" @error="onerror">
        </td>
        <td>{{product.description}}</td>
        <td>{{product.humanPrice}}</td>
    </tr>
  </material-transition-component>
</table>
</template>

<script>
export default {
  data(){
      return{
        endpoint:this.ruta,
        products:[]
      }
  },
  props:['ruta'],
  created(){
    this.fetchProducts();
  },
  methods:{
    fetchProducts(){
      axios({
        method:'GET',
        url:this.endpoint,
        data:{},
        headers:{
        'Accept':'application/json',
        'Content-Type':'application/json'
        }
      }).then((response)=>{
        console.log(response)
        this.products=response.data.data;
      })
    },
    onerror(event){
       event.target.src = this.product.noimg;

    },
    noimg(event){
      event.target.src = this.product.noimg;

    }
  }
}
</script>
