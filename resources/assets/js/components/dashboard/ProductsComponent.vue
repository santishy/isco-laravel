<template>
  <div class="container">
    <div class="col-md-12">
      <div class="card border-primary">
        <div class="card-header text-center text-bold">Productos</div>
        <div class="card-body">
          <!-- Aqui va formucarlio con  cantidad ,aplicar utilidad, utilidad aplicada anteriormente y existencia. -->
          <div class="row">
            <div class="col-sm-6 col-md-6">
              <dl v-if="product.id" class="row justify-content-center">
                <dt class="col-sm-3 text-center">
                  SKU
                </dt>
                <dd class="col-sm-9 text-justify">
                  {{product.sku}}
                </dd>
                <dt class="col-sm-3 text-center">
                  SKU Fabricante
                </dt>
                <dd class="col-sm-9 text-justify">
                  {{product.skuFabricante}}
                </dd>
                <dt class="col-sm-3 text-center">
                  Existencia
                </dt>
                <dd class="col-sm-9 text-justify">
                  {{product.existence}}
                </dd>
                <dt class="col-sm-3 text-center">
                  Descripción
                </dt>
                <dd class="col-sm-9 text-justify">
                  {{product.description}}
                </dd>
              </dl>
            </div>
            <div v-if="product.id" class="col-sm-6 col-md-6">
              <form-quotation-component :product="product"></form-quotation-component>
            </div>
          </div>
          <div class="row justify-content-end">
            <search-component :products="products"></search-component>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped text-center">
            <thead>
              <th>SKU</th>
              <th>SKU FABRICANTE</th>
              <th>DESCRIPCION</th>
              <th>P. PROVEEDOR</th>
              <th>P. DE VENTA</th>
              <th></th>
            </thead>
            <tbody>
              <tr v-for="product in products">
                <td>{{product.sku}}</td>
                <td>{{product.skuManufacturer}}</td>
                <td>{{product.description}}</td>
                <td>{{product.providerPrice}}</td>
                <td>{{product.humanPrice}}</td>
                <td><button class="btn btn-info btn-sm" @click="getProductData(product.id)"><i class="far fa-eye"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
        <infinite-loading @infinite="fetchProducts"></infinite-loading>
      </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';
import {mapMutations} from 'vuex';
export default {
  data(){
    return{
      product:{},
      page:1
    }
  },
  created(){
    //  this.fetchProducts();
  },
  computed:{
    ...mapState(['products'])
  },
  methods:{
    fetchProducts($state){
      axios({
        method:'get',
        url:'/products',
        params:{
          page:this.page
        }
      }).then((response)=>{
        if(response.data.data.length)
        {
          this.addProducts(response.data.data)
          this.page+=1;
          $state.loaded();
        }
        else
        {
          $state.completed()
        }
      }).catch((error)=>{
        console.log(error)
      })
    },
    getProductData(id){
      axios({
        url:'/products/'+id,
        method:'get'
      }).then((response)=>{
        this.product = response.data.data;
        document.querySelector("#ut").scrollIntoView({behavior:'smooth'});
      }).catch((error)=>{
        console.log(error);
      })
    },
    ...mapMutations(['getProducts','setProducts','addProducts'])
  }
}
</script>

<style lang="css" scoped>
</style>
