<template>
	<section>
		<div class="container-products">
			<product-card-component :key="product.id"
															:data-index="index"
															v-bind:product="product"
															v-for="(product,index) in products">
			</product-card-component>
		</div>
		<infinite-loading spinner="waveDots" @infinite="infiniteHandler">
			<div slot="no-more">No hay mas resultados</div>
			<div slot="no-results">No hay resultados :( </div>
		</infinite-loading>
	</section>
</template>
<script>
	export default{
		data(){
			return {
				products:[],
				endpoint:this.ruta,
				page:1
			}
		},
		props:['ruta','method'],
		created(){
			EventBus.$on('imgLocal',index => {
				this.products[index].unloadedImage = true;
			});
		},
		methods:{
			infiniteHandler($state){
				let ruta = this.endpoint+'?page='+this.page;
				axios({
					method:'get',
					url:ruta,
					data:{ajax:this.page},
					headers:{
					'Accept':'application/json',
					'Content-Type':'application/json'
					},
				}).then((response)=>{
					if(response.data.data.length)
					{
						this.page += 1;
						this.products = this.products.concat(response.data.data);
						$state.loaded()
					}
					else {
						$state.complete();
					}
				});
			}
		}
	}
</script>
