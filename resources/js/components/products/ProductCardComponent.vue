<template>
	<div class="product-card-container">
		<div class="card mb-3 shadow-sm border-0 mt-3">
				<div class="card-body d-flex flex-column">
					<div class="d-flex align-items-center mb-3 column ">
						<img class="img-responsive product-image"  :src="product.url_img" @error="onerror">
						<div class="ml-xl-3 ml-sm-0">
							<p class="card-text my-0">{{product.brand}}</p>
							<p class="card-text">SKU: {{product.skuManufacturer}}</p>
							<p class="card-text text-secondary" v-text="product.description"></p>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center ">
						<p style="font-size:1.5em;padding:0px" class="card-text text-danger font-weight-bolder mb-0" v-text="'$'+product.humanPrice"></p>
						<a :href="product.vinculo" class="btn btn-outline-primary pull-right text-decoration-none">Más información</a>
					</div>
				</div>
		</div>
	</div>

	<!-- <div class="product">
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
				<input type="hidden" name="id" :value="product.id">
				<input type="hidden" name="_token" :value="product.csrf">
				<input type="file" name="image" class="form-control imageUpdate">
				<button type="submit" class="btn btn-success">Enviar</button>
			</form>
		</div>
		</a>
	</div> -->
</template>
<script>
export default{
		data(){
			return {

			}
		},
		methods:{
			onerror(event){
				 event.target.src = this.product.noimg;

			},
			noimg(event){
				event.target.src = this.product.noimg;

			},
		},

		props:{
			product:{
				type:Object
			}
		}
	}
</script>
