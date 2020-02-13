<template>
  <div class="container">
    <div class="row">

      <div class="col-md-3">
        <div class="sidebar shadow-sm border-0" style="height:200px; background:white;">
          <div class="title-sidebar border-0 ">
            Lineas
          </div>
          <hr>
          <a @click.prevent="getSectionSeriesProducts(line.id_linea)" v-for="line in lineas" class="link-product" href="" v-text="line.linea">a</a>
        </div>
        <div class="sidebar shadow-sm border-0" style="height: 200px; background: white;">
          <div class="title-sidebar border-0 ">
            Series
          </div>
          <hr>
          <a v-for="serie in JSON.parse(series)" class="link-product" href="" v-text="serie.name"></a>
        </div>
      </div>
      <div class="col-md-9">
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
                <tr>
                  <th>SKU</th>
                  <th>SKU FABRICANTE</th>
                  <th>DESCRIPCION</th>
                  <th>P. PROVEEDOR</th>
                  <th>P. DE VENTA</th>
                  <th></th>
                </tr>

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
            <infinite-loading spinner="waveDots" @infinite="fetchProducts">
              <div slot="no-more">No hay mas resultados</div>
              <div slot="no-results">No hay resultados :( </div>
            </infinite-loading>
          </div>
          </div>
        </div>
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
      page:1,
      lineas:[]
    }
  },
  props:['url','section','lines','series'],
  created(){
    this.lineas = JSON.parse(this.lines);
    console.log(this.lineas)
    if(this.id){
      this.url = this.url +'/' + this.section;
    }
  },
  computed:{
    ...mapState(['products'])
  },
  methods:{
    fetchProducts($state){
      axios({
        method:'get',
        url:this.url,
        params:{
          page:this.page
        },
        headers: {
          'Content-Type': 'application/json;charset=UTF-8',
          "Access-Control-Allow-Origin": "*",
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
          $state.complete();
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
    getSectionSeriesProducts(serie_id){
      axios({
        url:'/section-series-products/',
        params:{
          'serie_id' : serie_id,
          'id_section' : this.section
        },

      }).then((res) => {
        console.log(res.data)
      }).catch(err => {
        console.log(err)
      })
    },
    ...mapMutations(['getProducts','setProducts','addProducts'])
  }
}
</script>

<style lang="css" scoped>
</style>
