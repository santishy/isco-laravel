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
  props:['shopping_cart_id'],
  data(){
    return{
      order:null,
      url:'/orders/'+this.shopping_cart_id
    }
  },
  created(){
    this.getOrder(this.shopping_cart_id);
  },
  methods:{
    getOrder(id){
      axios({
        method:'GET',
        url:this.url,
        params:{
          id:this.shopping_cart_id
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
