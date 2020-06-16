<template>
	<div class="product-card-container">
		<div class="card mb-2 shadow-sm border-0 mt-2">
				<div class="card-body d-flex flex-column">
					<div class="d-flex align-items-center mb-3 column ">
						<img loading="lazy" class="img-fluid product-image"  :src="product.url_img" @error="onerror">
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
</template>
<script>
export default{
		data(){
			return {
				failedImageCount:0,
			}
		},
		created(){
		},
		methods:{
			onerror(event){
				EventBus.$emit('imgLocal',this.$attrs['data-index'])
				if(this.product.unloadedImage){
					event.target.src = this.product.imgLocal;
					if(this.failedImageCount){
						event.target.src = this.product.noimg;
					}
					this.failedImageCount++;
				}
				else
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
