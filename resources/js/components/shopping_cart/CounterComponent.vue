<template>
	<div class="viewShoppingCart">
        <span class="badge">{{productsCount}}</span>
        <i class="fa fa-shopping-cart fa-1x" aria-hidden="true"></i>
  </div>
</template>

<script>
	export default{
		props:["count"],
		created(){
			return window.store.commit('set',this.count);
		},
		computed:{
			productsCount(){
				return window.store.state.productsCount;
			}
		}
	}
</script>
