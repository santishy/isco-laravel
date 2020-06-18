<template>
  <div class=" d-flex submenu justify-content-center">
      <!-- <form action="{{url('search/')}}"  method="post"  id="formSearch"> -->
      <form id="formSearch"class="col-12" style="height:100%" @submit.prevent="search">
          <div class="input-form">
              <input type="text"
                     v-model="word"
                     class="text-center"
                     placeholder="Buscar producto"
                     autocomplete="off" name="word"
                     id="word"
                     style="color:white;::-webkit-input-placeholder { color: red; }
">
              <label style="color:white" for="word">Busca productos</label>
          </div>
      </form>
  </div>
</template>

<script>
import {mapMutations} from 'vuex';
export default {
  data(){
    return{
      word:'',

    }
  },
  methods:{
    ...mapMutations(['setMatchingProducts','setSearching']),

    async search(e){
      e.preventDefault();
      this.setMatchingProducts([]);
      this.setSearching();
      const request = await axios({
        url:'/search',
        method:'POST',
        data:{word:this.word},
      }).then( res => {
        this.setMatchingProducts(res.data.data);

      }).catch( err => {
        console.log(err)
      });
      this.setSearching();
    }
  },

}
</script>

<style lang="css" scoped>
</style>
