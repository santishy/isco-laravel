<template>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div v-if="lineas.length" class="sidebar shadow-sm border-0" style="height:200px; background:white;">
          <div class="title-sidebar border-0 ">
            Lineas
          </div>
          <hr>
          <a v-for="line in lineas"
             @click.prevent="getSectionLineProducts(line.id_linea)"
             class="link-product"
             href="" v-text="line.linea">
          </a>
        </div>
        <div v-if="JSON.parse(series).length" class="sidebar shadow-sm border-0" style="height: 200px; background: white;">
          <div class="title-sidebar border-0 ">
            Series
          </div>
          <hr>
          <a v-for="serie in JSON.parse(series)"
             class="link-product"
             @click.prevent="getSectionSeriesProducts(serie.id)"
             href=""
             v-text="serie.name">
          </a>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card border-0 shadow-sm bg-white">
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
          <div v-if="this.products.length" class="table-responsive">
            <table class="table table-striped text-center">
              <thead>
                <tr>
                  <th>Imagen</th>
                  <th>SKU</th>
                  <th>SKU FABRICANTE</th>
                  <th>DESCRIPCION</th>
                  <th>P. PROVEEDOR</th>
                  <th>P. DE VENTA</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product,index) in products" :key="product.id">
                  <td class="bg-white">
                    <figure class="dashboard-images-container mb-0">
                      <img style="width:100%;" class="img-responsive product-image"
                           :src="product.url_img"
                           @error="onerror">
                      <div class="upload-btn-container">
                        <upload-image :index="index"/>
                      </div>
                    </figure>
                  </td>
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
          <div v-else>
            <h3 class="text-center">Cargando datos...</h3>
          </div>
          <infinite-loading v-if="infinity" spinner="waveDots" @infinite="fetchProducts">
            <div slot="no-more">No hay mas resultados</div>
            <div slot="no-results">No hay resultados :( </div>
          </infinite-loading>
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
      lineas:[],
      route:this.url,
      infinity:true,
    }
  },
  props:['url','section','lines','series'],
  created(){
    this.lineas = JSON.parse(this.lines);
    EventBus.$on('onFileSelected',this.getImage);
    if(this.id){
      this.url = this.url +'/' + this.section;
    }
  },
  computed:{
    ...mapState(['products'])
  },
  methods:{
    ...mapMutations(['getProducts','setProducts','addProducts']),
    fetchProducts($state){
      axios({
        method:'get',
        url:this.route,
        params:{
          page:this.page,
        },
        headers: {
          'Content-Type': 'application/json;charset=UTF-8',
          "Access-Control-Allow-Origin": "*",
      }
      }).then((response)=>{
        if(response.data.data.length)
        {
          this.page+=1;
          this.addProducts(response.data.data)
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
    getSectionLineProducts(line_id){
      this.setProducts([]);
      axios({
        url:'/section-line-products/',
        params:{
          'line_id' : line_id,
          'section_id' : this.section
        },
      }).then((res) => {
        if(res.data.data.length){
          this.infinity = false;
          this.setProducts(res.data.data);
        }
      }).catch(err => {
        console.log(err)
      })
    },
    getSectionSeriesProducts(serie_id){
      this.setProducts([]);
      axios({
        url:'/section-series-products/',
        params:{
          'id_serie': serie_id,
          'section_id': this.section
        },
        method:'GET'
        }).then((res)=>{
          if(res.data.data.length){
            this.infinity = false;
            this.setProducts(res.data.data)
          }
        }).catch((err) => {
          console.log(err)
        });
    },
    onerror(event){
       event.target.src = this.product.noimg;

    },
    noimg(event){
      event.target.src = this.product.noimg;

    },

  }
}
</script>
