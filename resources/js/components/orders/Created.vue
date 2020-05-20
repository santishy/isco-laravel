<template>
  <div class="card border-0 shadow-sm ">
    <div class="card-body">
      <div class="card-title d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Datos de envío</h3>
        <div>
          <i v-if="!editing" @click="edit" class="fas fa-edit fa-2x"></i>
          <i v-else @click="edit();" class="fas fa-check-square fa-2x"></i>
        </div>

      </div>
      <template v-if="!editing && order">
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
        <div class="text-muted">
          {{order.postal_code}}
        </div>
        <div class="text-muted">
          {{order.recipient_name}}
        </div>
      </template>
      <order-edit v-else :order="order" :editing="editing"></order-edit>
    </div>
  </div>
</template>

<script>
export default {
  props:['id'],
  data(){
    return{
      order:null,
      url:'/orders/'+this.id,
      editing:false,
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
    },
    edit(){
      this.editing = !this.editing;
    },
  }
}
</script>

<style lang="css" scoped>
</style>
