<template>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Productos
    </a>
    <div class="dropdown-menu dashboard-menu-productos" aria-labelledby="navbarDropdown">
      <div style="overflow-x:none;" class="d-flex  flex-wrap ">
          <a v-for="item in items" class="dropdown-item text-center"  style="width:50%"
             :href="url_products + item.id">{{item.name}}</a>
      </div>
    </div>
  </li>
</template>

<script>
export default {
  data(){
    return{
      items:[],
      url_products:''
    }
  },
  props:['url'],
  created(){
    axios({
      method:'GET',
      url:this.url,
      headers: {
            'Content-Type': 'application/json',
        }
    }).then(res=>{
      this.items = res.data.data
      this.url_products = res.data.url
    }).catch(err =>{
      console.log(err)
    })
  }
}
</script>

<style lang="css" scoped>
</style>
