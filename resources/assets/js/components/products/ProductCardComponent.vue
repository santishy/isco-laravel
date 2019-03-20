<template>
	<div class="product">
		<a :href="product.vinculo">
		<div class="image-product">
			<img class="img-responsive" :src="product.url_img" @error="onerror">
		</div>
		<div class="content-description">
			<p>{{ product.description }}</p>
			<p><span>SKU:</span>{{product.skuManufacturer}}</p>
			<p>${{ product.humanPrice }}</p>
		</div>
		<div v-if="product.auth">
			<form :action="product.route" :method="'POST'" :enctype="'multipart/form-data'">
				<label>Subir imagen</label>
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="_token" :value="product.csrf">
				<input type="file" name="image" class="form-control imageUpdate">
				<button type="submit" class="btn btn-success">Enviar</button>
			</form>
		</div>
		</a>
	</div>
</template>
<script>
export default{
		data(){
			return {

			}
		},

		created(){

		},
		methods:{
			onerror(event){
				 event.target.src = this.product.noimg;

			},
			noimg(event){
				event.target.src = this.product.noimg;

			}
		},
		props:{
			product:{
				type:Object
			}
		}
	}
</script>
