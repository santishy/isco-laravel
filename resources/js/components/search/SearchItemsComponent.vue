<template>
	<div class="d-flex justify-content-center">
		<div v-if="!products.length" class="card shadow-sm mb-4 mt-4 border-0 bg-white" style="width: 22rem;">
			<div class="card-body">
				<h3 class="mb-0 h-100 text-center">Buscando...</h3>
			</div>
		</div>
		<material-transition-component
		v-else
		:css="false"
		name="fadeIn"
		class="container-products">
			<product-card-component :key="product.id"
															:data-index="index"
															:index="index"
															v-bind:product="product"
															v-for="(product,index) in products">
			</product-card-component>
		</material-transition-component>
	</div>
</template>
<script>
	export default{
		data(){
			return {
				products :[],
				endpoint:this.ruta
			}
		},
		props:['ruta','method'],
		mounted(){
			this.search();
			EventBus.$on('imgLocal',index => {
				this.products[index].unloadedImage = true;
				console.log('...............................')
			})
		},
		methods:{
			search(){
				var formData = new FormData(document.getElementById("formSearch"));
				axios({
					method:'POST',
					url:this.endpoint,
					data:formData,
					headers:{
					'Accept':'application/json',
					'Content-Type':'application/json'
					},
				}).then((response)=>{
					// console.log(response.data+" "+formData);
					// for (var value of formData.values()) {
					//    console.log(value);
					// }
					this.products = response.data.data;
				})
			},
			unloadedImage(event){

			}
		}
	}
</script>
