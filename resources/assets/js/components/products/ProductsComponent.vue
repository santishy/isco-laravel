<template>
	<section>
		<material-transition-component 
		:css="false"
		name="fadeIn"
		tag="div"
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
			if(this.method == 'GET')
				return this.fetchProducts();
			return this.productsLine();
		},
		methods:{
			fetchProducts(){
				// axios.get(this.endpoint).then((response)=>{
				// 	console.log(response.data);
				// 	this.products = response.data.data;
				// })
				axios({
					method:this.method,
					url:this.endpoint+"&ajax=1",
					data:{ajax:'1'},
					headers:{
					'Accept':'application/json',
					'Content-Type':'application/json'
					},
				}).then((response)=>{
					console.log(response.data);
					this.products = response.data.data;
				})
			},
			productsLine(){
				var formData = new FormData(document.getElementById("frmSeries"));
				axios({
					method:this.method,
					url:this.endpoint,
					data:formData,
					headers:{
					'Accept':'application/json',
					'Content-Type':'application/json'
					},
				}).then((response)=>{
					console.log(response.data+"/n"+formData.values());
					for (var value of formData.values()) {
					   console.log(value); 
					}
					this.products = response.data.data;
				})
			}
			// searchSeries(){
			// 	axios({
			// 		method:'GET',
			// 		url:this.endpoint,
			// 		data:{document.querySelector("#frmSeries").serialize()},
			// 		headers:{
			// 		'Accept':'application/json',
			// 		'Content-Type':'application/json'
			// 		},
			// 	}).then((response)=>{
			// 		console.log(response.data);
			// 		this.products = response.data.data;
			// 	})
			// }
		}
	}
</script>