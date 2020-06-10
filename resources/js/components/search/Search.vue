<template>
  <div class=" d-flex submenu justify-content-center">
      <!-- <form action="{{url('search/')}}"  method="post"  id="formSearch"> -->
      <form id="formSearch"class="col-12" style="height:100%" @submit="search">
          <div class="input-form">
              <input type="text" v-model="word" class="text-center" 
                     placeholder="Buscar producto"
                     autocomplete="off" name="word"
              id="word">
              <label style="color:white" for="word">Busca productos</label>
          </div>
      </form>
  </div>
</template>

<script>
export default {
  data(){
    return{
      word:''
    }
  },
  methods:{
    search(e){
      e.preventDefault();
      axios({
        url:'/search',
        method:'POST',
        data:{word:this.word},
      }).then( res => {
        console.log(res.data)
      }).catch( err => {
        console.log(err)
      })
    }
  }
}
</script>

<style lang="css" scoped>
</style>
