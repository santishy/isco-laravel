<template>
  <form v-on:submit.prevent="search" class="mr-3" action="index.html" method="post">
    <div class="form-group">
      <input  type="text" id="search" placeholder="Buscar" name="search"  class="form-control" value="">
    </div>
  </form>
</template>

<script>
import {mapMutations} from 'vuex';
export default {
  methods:{
    search(){
      axios({
        url:'/search',
        method:'POST',
        data:{word:document.querySelector("#search").value}
      }).then((response)=>{
        this.setProducts(response.data.data);
      }).catch((error)=>{
        console.log(error)
      })
    },
    ...mapMutations(['setProducts'])
  }
}
</script>

<style lang="css" scoped>
</style>
