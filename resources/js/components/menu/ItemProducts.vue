<template>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Productos
    </a>
    <div class="dropdown-menu dashboard-menu-productos" aria-labelledby="navbarDropdown">
      <div style="overflow-x:none;" class=" d-flex  flex-wrap ">
          <a v-for="product in products" class="dropdown-item text-center"  style="width:50%"
             :href="`/section-products/${product.id_seccion}`">{{product.seccion}}</a>
      </div>
    </div>
  </li>
</template>

<script>
export default {
  data(){
    return{
      products:[]
    }
  },
  created(){
    axios({
      method:'GET',
      url:'/item-products',
      headers: {
            'Content-Type': 'application/json',
        }
    }).then(res=>{
      this.products = res.data.data
    }).catch(err =>{
      console.log(err)
    })
  }
}
</script>

<style lang="css" scoped>
</style>
