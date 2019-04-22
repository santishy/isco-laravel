
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
class inputMD{
	constructor(selector){
		this.input = document.querySelector(selector);
		this.nonEmpty();
		this.bindEvents();
	}
	bindEvents(){

		this.input.addEventListener("keyup",()=>{

			this.nonEmpty();
		})
	}
	nonEmpty(){
		if(this.input.value=="") return this.input.classList.remove('non-empty')
		return this.input.classList.add('non-empty');
	}
}
(function(){
	//var obj = new inputMD(".input-form input");


})()

require('./bootstrap');

window.Vue = require('vue');

const Vuex = require('vuex');
window.store = new Vuex.Store({
	state:{
		productsCount:0
	},
	mutations:{
		increment(state){
			return state.productsCount++;
		},
		set(state,value){
			return state.productsCount=value;
		}
	}
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// var variable = require('./frontend');
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('product-card-component', require('./components/products/ProductCardComponent.vue'));
Vue.component('products-component', require('./components/products/ProductsComponent.vue'));
Vue.component('material-transition-component',require('./components/animations/MaterialCollectionComponent.vue'))
Vue.component('search-items-component',require('./components/search/SearchItemsComponent.vue'));
Vue.component('btn-add-to-cart',require('./components/products/AddToCartComponent.vue'));
Vue.component('counter-products-component',require('./components/shopping_cart/CounterComponent.vue'));
Vue.component('cart-component',require('./components/shopping_cart/CartComponent.vue'));
Vue.component('quote-button-component',require('./components/shopping_cart/QuoteButtonComponent.vue'));
Vue.component('quotation-header',require('./components/shopping_cart/QuotationHeaderComponent.vue'));
const app = new Vue({
    el: '#app'
});
/************************************************************************************************************/


// $.fn.editable.defaults.mode='inline';
// $.fn.editable.defaults.ajaxOptions={type:'PUT'};
var alerta=$("#alerta");
var btn_add_product=$("#btn-add-product");
var modalCart=$("#modalCart");

!function(r,n){"function"==typeof define&&define.amd?define(n):"object"==typeof exports?module.exports=n():r.transformicons=n()}(this||window,function(){"use strict";var r={},n={transform:["click"],revert:["click"]},t=function(r){return"string"==typeof r?Array.prototype.slice.call(document.querySelectorAll(r)):void 0===r||r instanceof Array?r:[r]},o=function(r){return"string"==typeof r?r.toLowerCase().split(" "):r},e=function(r,e,f){var i=(f?"remove":"add")+"EventListener",s=t(r),a=s.length,u={};for(var l in n)u[l]=e&&e[l]?o(e[l]):n[l];for(;a--;)for(var d in u)for(var m=u[d].length;m--;)s[a][i](u[d][m],c)},c=function(n){r.toggle(n.currentTarget)};return r.add=function(n,t){return e(n,t),r},r.remove=function(n,t){return e(n,t,!0),r},r.transform=function(n){return t(n).forEach(function(r){r.classList.add("tcon-transform")}),r},r.revert=function(n){return t(n).forEach(function(r){r.classList.remove("tcon-transform")}),r},r.toggle=function(n){return t(n).forEach(function(n){r[n.classList.contains("tcon-transform")?"revert":"transform"](n)}),r},r});
// CLASE SLIDER

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
class Slider{
	constructor(selector,velocidad){
		this.move =  this.move.bind(this)
		//this.contador=this.move.bind(this)
		// this.itemsCount=this.itemsCount(this)
		this.velocidad=velocidad;
		this.moveLeft=this.moveLeft.bind(this)
		this.moveRight=this.moveRight.bind(this)
		this.slider= document.querySelector(selector);
		this.selector=selector;
		console.log(this.slider)
		this.interval = null
		this.contador = 0
		this.itemsCount = document.querySelectorAll(this.selector+" > *").length - 5;
		this.start()
		console.log(selector+' .btnLeft');
		$(selector+'+ + a.btnLeft').on('click',this.moveLeft);
		$(selector+'+ a.btnRight').on('click',this.moveRight);
		// document.selector.querySelector('.btnLeft').addEventListener('click',this.moveLeft)
		// document.selector.querySelector('.btnRight').addEventListener('click',this.moveRight)
	}
	moveLeft(event){
		event.preventDefault();
		clearInterval(this.interval)
		if(this.contador>0){
			this.contador=this.contador-1;
			this.slider.style.left="-"+this.contador*20+"%";
		}
		this.interval=window.setInterval(this.move,4000)
	}
	moveRight(event){
		event.preventDefault();
		clearInterval(this.interval);
		if(this.contador<this.itemsCount){
			this.contador=this.contador+1;
			this.slider.style.left="-"+this.contador*20+"%";
		}
		this.interval=window.setInterval(this.move,this.velocidad)
	}
	start(){
		this.interval = window.setInterval(this.move,this.velocidad)
	}
	move()
	{

		if(this.contador < this.itemsCount)
			this.contador++;
		else
			this.contador = 0
		this.moveTo(this.contador)

	}
	moveTo(index){
		let multi=-1;
		this.slider.style.left=multi*index*20+"%";
	}
}
/*****************************SCROLL PARA MENU***************************/
var menu=document.querySelector('#container-menu');
if(menu!=null)
	var heightScroll=menu.offsetTop;
var menuNave=document.querySelector('.menu');
var menuSections=document.querySelector('.menu-sections');
var body=document.querySelector('body');
var heightBody=body.getBoundingClientRect().height;
(()=>{

	if($("#sliderProducts").length>0){
		new Slider('#sliderProducts',4000);
		new Slider('#sliderBrands',5000);
		new Slider('#sliderOferts',3500);
	}
	//activar menu
	if($('.icon-menu-fa').length>0)
	{
		document.querySelector('.icon-menu-fa').addEventListener('click',function(){
			document.querySelector('.menu').classList.add('active');
		});
		document.querySelector('.close').addEventListener('click',function(){
			document.querySelector('.menu').classList.remove('active');
		});
		elements= document.querySelectorAll('.submenu');
		elements.forEach(function(el,i){
			el.addEventListener('click',function(e){
			this.nextElementSibling.classList.add('active');
			})
		})
		elements = document.querySelectorAll('.atras');
		elements.forEach(function(el,i){
			el.addEventListener('click',function(e){
			this.parentNode.classList.remove('active');

		});
		})
	}

})();

if($('.menu-sections').length)
	var menuSectionsTop=document.querySelector('.menu-sections').getBoundingClientRect().top;
if(body.scrollHeight>heightBody){
	// if($.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()))){
 //    alert('Hola! Entras desde un dispositivo móvil o tablet!');
	// }
	if(screen.width > 1024)
		window.addEventListener('scroll',function(){

			if(window.pageYOffset > heightScroll)
			{
				menu.classList.add('fixed');
			}
			else {

				menu.classList.remove('fixed');

				if($('.menu-sections').length)
				{
					menuSections.classList.add('margin-top');//cambio el sidebar con esta y la ultima linea de este bloke
					menuSections.style.top=menuSectionsTop-window.pageYOffset+'px';
				}
			}
		})}
//-----------------------------------------------------------------------------
$(document).ready(function(){
	//new inputMD('.input-form input');
	$(".btn_borrar_utilidad").on('click',function(){
		var tr = $(this).parent().parent();
		utility_id = $(this).data('id');
		var autorizathion = confirm("¿Estás seguro de eliminar esta utilidad?");
		if(autorizathion)
			$.ajax({
				type:'DELETE',
				dataType:'json',
				url:'utilities/'+utility_id,
				data:{
					id:utility_id
				}
				,success:function(response){
					if(response.result)
						tr.remove();
				},error:function(xhr,error,e){

				}
			}).then(console.log(response));
		})
	$('.imageUpdate').change(function(){
		console.log('esto es el html '+$(this).parent().parent())
		$(this).parent().parent().submit();
	})
/****************************Footer******************************************
****************************************************************************/
$(".menu-list").on('click',function(event){
	event.preventDefault();
	ul=$(this).parent().parent()
	$type=$(this).data('type')
	$(this).parent().remove()
	if($type=='lines'){
		var ruta='lineas/'
	}else if($type='products')
		var ruta='products/list';
	$.ajax({
		url:ruta,
		type:'GET',
		data:{},
		dataType:'JSON',
		success:function(resp){
			if(typeof(resp.lines)!='undefined')
				list=resp.lines
			else
				list=resp.products
			for(i=0;i<list.length;i++){
				var li=document.createElement('li')
				var a=document.createElement('a')
				if(typeof(resp.lines)!='undefined')
					{a.innerHTML=list[i].linea
					a.href=ruta+list[i].id_linea}
				else
				{
					a.innerHTML=list[i].seccion
					a.href=ruta+list[i].id_seccion
				}
				li.appendChild(a)
				ul.append(li)
			}
		},
		error:function(){

		},
		complete:function(){

		}

	})
});
/***************************************************************************
*********************SECCIONES -> SERIES ************************************/
$('.checkbox_serie').on('click',function(){
	$("#frmSeries").submit();
})
/****************************************************************************
//CONTROLAR ERROR DE IMAGEN NO DISPONIBLE*/


/******************************************************************************/
// ELIMINAR DEL CART
$(".suprInShoppingCart").on('click',destroyInShoppingCart);
/******************************************************************************/
// boton superior derecho, Mostrar el carrito
	$(".viewShoppingCart").on('click',function(event){
		event.preventDefault();
		modalCart.modal("show");
	});
/************************************************************/
	$('#carousel-example-generic').carousel();
	$('#carousel-brands').carousel();
/*****************************************************************/
// Edicion de cantidad de productos (qty) en el carrito
	alerta.hide();
	$('.set-qty').editable({
			dataType:'json',
			type:'PUT',
			success: function(response, newValue) {
		    	if(!response.success)
		    	{
		    		return 'Excede las existencias';
		    	}
			}
		});
/***************************************************************/
//Datos de las ordenes , como administrador... modificaciones dashboard
	$('.set-guide-number').editable(
		{
			dataType:'json',
			success: function(response, newValue) {
		    	if(!response.success)
		    		alert('revasa las existencias');
			}
		});
	$('.select-status').editable({
		source:[
			{value:'creado',text:'Creado'},
			{value:'enviado',text:'Enviado'},
			{value:'recibido',text:'Recibido'}
		]
	});
	$('.set-recipient-name').editable();
	$('.set-email').editable();
	$('.set-address').editable();
	$('.set-city').editable();
	$('.set-state').editable();
/**************************************************************/
//paypal...
$('#formCardPago').submit(function(event){
	event.preventDefault();
	$("#modal").modal('show');
	return false;
});
$('#btnModal').on('click',function(){
	var form=$(this).data('form');
	var ruta=$(this).data('ruta');
	var spinner=$('.spinner');
	$.ajax({
		url:ruta,
		type:'POST',
		dataType:'json',
		data:$("#"+form).serialize(),
		beforeSend:function(){
			$("#btnModal").html('Enviando...');
			$("#spinner").removeClass('spinner');
			$("#spinner").addClass('spinner-visible');
		},
		success:function(resp)
		{
			if(resp.error)
			{
				crearAlerta('alert-info','alert-warning','Verifique los datos de su tarjeta.');
			}
			else
			{
				crearAlerta('alert-warning','alert-info','Su compra a sido realizada, recibira un correo con los datos correspondientes.');
			}

		},
		error:function(error)
		{

		},
		complete:function()
		{
			$("#btnModal").html('Listo');
			$("#spinner").removeClass('spinner-visible');
			$("#spinner").addClass('spinner');
		}

	});
	//$("#"+form).submit();
});

});
function crearAlerta(clase1,clase2,mensaje)
{
	alerta.hide();
	alerta.removeClass(clase1);
	alerta.addClass(clase2);
	alerta.find('a').html(mensaje);
	alerta.show();
}
/****************************************************************************************/
// Habilitar el boton para agregar al carrito
$('#btn-add-product').attr('disabled',true);
$('input:radio[name="almacen"]').change(function(){
	if($(this).is(':checked'))
	{
		$("#btn-add-product").attr('disabled',false);
		$("#almacen").val($(this).val());
		$("#existencia").val($(this).data('existencia'));
	}
});
// agregar al carrito
// btn_add_product.on('click',function(){

// 	$.ajax({
// 		url:$("#form-add-product").attr('action'),
// 		beforeSend:function(){
// 			btn_add_product.attr('disabled',true);
// 			btn_add_product.text('Cargando...');
// 		},
// 		type:'post',
// 		data:$("#form-add-product").serialize(),
// 		dataType:'JSON',
// 		success:function(resp){
// 			if(resp.success)
// 			{
// 				$(".container-right a span").text(resp.productsCount);
// 				addCart(resp.article,resp.inShoppingCart);
// 				modalCart.modal('show');
// 			}
// 		},
// 		error:function(error,xhr,a)
// 		{
// 			console.log(error+" "+xhr+" "+a );
// 		},
// 		complete:function(){
// 			btn_add_product.attr('disabled',false);
// 			btn_add_product.text('Agregar al carrito');
// 		}

// 	});
// });
// function addCart(article,inShoppingCart)
// {
// 	var tbody=document.querySelector('#tbody-cart');
// 	tr=document.createElement('tr');
// 	tr.classList.add('tr-cart');
// 	td=document.createElement('td');
// 	img=document.createElement('img');
// 	img.classList.add('img-responsive');
// 	img.setAttribute('src',"http://www.pchmayoreo.com/media/catalog/product/"+article.sku.substr(0,1)+"/"+article.sku.substr(1,1)+"/"+article.sku+".jpg" );
// 	td.appendChild(img);
// 	tr.appendChild(td);
// 	td=document.createElement('td');
// 	td.innerHTML=article.descripcion;
// 	tr.appendChild(td);
// 	td=document.createElement('td');
// 	td.innerHTML=inShoppingCart.qty;
// 	tr.appendChild(td);
// 	td=document.createElement('td');
// 	button=document.createElement('button');
// 	button.dataset.id=inShoppingCart.id;
// 	button.classList.add('btn');
// 	button.classList.add('btn-danger');
// 	button.classList.add('btn-xs');
// 	button.classList.add('suprInShoppingCart');
// 	button.addEventListener('click',destroyInShoppingCart)
// 	span=document.createElement('span');
// 	span.classList.add('glyphicon-trash');
// 	span.classList.add('glyphicon');
// 	button.appendChild(span);
// 	td.appendChild(button);
// 	tr.appendChild(td);
// 	tbody.appendChild(tr);
// }
function destroyInShoppingCart()// trucha!!! se manda el id en la uri
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
