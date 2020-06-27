<template>
  <div class=" d-flex submenu justify-content-center align-items-center">
      <!-- <form action="{{url('search/')}}"  method="post"  id="formSearch"> -->
      <form id="formSearch"class="col-md-12 col-sm-12" style="height:100%" @submit.prevent="search">
          <div class="input-form">
              <input type="text"
                     v-model="word"
                     @keyup.esc="closeSearch"
                     class="text-center"
                     placeholder="Buscar producto"
                     autocomplete="off" name="word"
                     id="word"
                     ref="search"
                     style="color:white;font-weight:bold;
">
              <a  v-if="matchingProducts.length" class="my-0 closeSearch text-decoration-none py-3 px-0">
                <i @click="closeSearch" class="fas fa-times"></i>
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
        e.target.blur();
      }).catch( err => {
        console.log(err)
      });
      console.log(e.target[0])
      e.target[0].blur();
      this.setSearching();
    },
    closeSearch(){
      this.setMatchingProducts([]);
      this.word='';
    }
  },
  computed:{
    ...mapState(['matchingProducts']),
  }
}
</script>

<style lang="css" scoped>
</style>
