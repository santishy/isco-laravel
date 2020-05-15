<template>
  <div class="card border-0 shadow-sm my-4">
    <div class="card-body">
      <div class="text-muted">
        {{order.line1}}
      </div>
      <div class="text-muted">
        {{order.line2}}
      </div>
      <div class="text-muted">
        {{order.state}}
      </div>
      <div class="text-muted">
        {{order.city}}
      </div>
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
        if(res.data){
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
