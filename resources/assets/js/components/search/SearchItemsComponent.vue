<template>
	<section>
		<material-transition-component 
		:css="false"
		name="fadeIn"
		class="container-products">
			<product-card-component :key="product.id" :data-index="index" v-bind:product="product" v-for="(product,index) in products"></product-card-component>
		</material-transition-component>
	</section>
	
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
		created(){
			this.search();
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
					console.log(response.data+" "+formData);
					for (var value of formData.values()) {
					   console.log(value); 
					}
					this.products = response.data.data;
				})
			},
			
		
		}
	}
</script>