<template>
	<a class="viewShoppingCart submenu" style="height:100%">
        <span class="badge">{{productsCount}}</span>
        <i class="fa fa-shopping-cart fa-1x" aria-hidden="true"></i>
  </a>
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
