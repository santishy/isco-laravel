<template>
  <div class=" d-flex submenu justify-content-center align-items-center">
      <!-- <form action="{{url('search/')}}"  method="post"  id="formSearch"> -->
      <form id="formSearch"class="col-12" style="height:100%" @submit.prevent="search">
          <div class="input-form">
              <input type="text"
                     v-model="word"
                     @keyup.esc="closeSearch"
                     class="text-center"
                     placeholder="Buscar producto"
                     autocomplete="off" name="word"
                     id="word"
                     style="color:white;font-weight:bold;
">
              <a @click="closeSearch" v-if="matchingProducts.length" class="closeSearch text-decoration-none text-white">
                <i class="fas fa-times"></i>
              </a>
              <label style="color:white" for="word">Busca productos</label>
          </div>
      </form>


  </div>
</template>

<script>
import {mapMutations,mapState} from 'vuex';
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
    },
    closeSearch(){
      this.setMatchingProducts([]);
    }
  },
  computed:{
    ...mapState(['matchingProducts']),
  }
}
</script>

<style lang="css" scoped>
</style>
