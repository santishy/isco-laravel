<template>
	<button id="btn-add-product" type="button" class="btn btn-block btn-primary" @click="addToCart">{{message}}</button>
</template>
<script>
	export default{
		data(){
			return {
				message:'Agregar al carrito',
				endpoint:'/in_shopping_carts'
			}
		},
		props:{
			product:{
				type:Object
			}
		},
		methods:{
			addToCart(){

				var form = new FormData (document.querySelector("#form-add-product"))
				axios({
					url:this.endpoint,
					method:'POST',
					data:form,
					headers:{
					'Accept':'application/json',
					'Content-Type':'application/json'
					}
				}).then((response)=>{
					window.store.commit("increment");
					
					 $(".container-right a span").text(response.data.productsCount);
					 this.addCart(response.data.article,response.data.inShoppingCart);
					 $("#modalCart").modal('show');
				})
			},
			addCart(article,inShoppingCart)
			{
				console.log(article)
				var tbody=document.querySelector('#tbody-cart');
				var tr=document.createElement('tr');
				tr.classList.add('tr-cart');
				var td=document.createElement('td');
				var img=document.createElement('img');
				img.classList.add('img-responsive');
				img.setAttribute('src',"http://www.pchmayoreo.com/media/catalog/product/"+article.sku.substr(0,1)+"/"+article.sku.substr(1,1)+"/"+article.sku+".jpg" );
				td.appendChild(img);
				tr.appendChild(td);
				td=document.createElement('td');
				td.innerHTML=article.descripcion;
				tr.appendChild(td);
				td=document.createElement('td');
				td.innerHTML=inShoppingCart.qty;
				tr.appendChild(td);
				td=document.createElement('td');
				var button=document.createElement('button');
				button.dataset.id=inShoppingCart.id;
				button.classList.add('btn');
				button.classList.add('btn-danger');
				button.classList.add('btn-xs');
				button.classList.add('suprInShoppingCart');
				button.addEventListener('click',this.destroyInShoppingCart)
				var span=document.createElement('span');
				span.classList.add('glyphicon-trash');
				span.classList.add('glyphicon');
				button.appendChild(span);

				td.appendChild(button);
				tr.appendChild(td);
				tbody.appendChild(tr);
			},
			 destroyInShoppingCart()// trucha!!! se manda el id en la uri
			{
				button=$(this);
				$.ajax({
					url:'/in_shopping_carts/'+$(this).data('id'),
					type:'DELETE',
					dataType:'JSON',
					
					data:{id:$(this).data('id'),_token:$('#tbody-cart').data('token')},
					boforeSend:function()
					{
					},
					success:function(resp)
					{
						if(resp.ban)
							button.parent().parent().remove();
					},
					error:function(error,xhr,data)
					{
						alert(error+' '+xhr);
					},
					complete:function()
					{

					}
				})
			}
		}
	}
</script>