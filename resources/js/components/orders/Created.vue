<template>
  <div class="card">
    <div class="card-body">
      <table>
        <tbody>
          <tr>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props:['id'],
  data(){
    return{
      order:null,
      url:'/orders/'+this.id
    }
  },
  created(){
    this.getOrder(this.id);
  },
  methods:{
    getOrder(id){
      axios({
        method:'GET',
        url:this.url,
        params:{
          order:this.shopping_cart_id
        }
      }).then((res)=>{
        if(res.data.length){
          this.order = res.data
        }
      }).catch((err) => {
        console.log(err)
      })
    }
  }
}
</script>

<style lang="css" scoped>
</style>
