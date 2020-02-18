<template>
  <form enctype="multipart/form-data">
    <input style="width:100px"
           type="file"
           @change="onFileSelected"
           :class="['form-control',
           hasError.archive ? 'is-invalid' : '']">
  </form>
</template>

<script>
import {mapMutations} from 'vuex';
import {mapState} from 'vuex';
export default {
  data(){
    return {
      hasError:{},
      form:{}
    }
  },
  props:['index'],
  computed:{
    ...mapState(['products'])
  },
  methods:{
    ...mapMutations(['updateProductByIndex']),
    onFileSelected(event){
        let file = event.target.files[0];
        this.form.image = file;

        //EventBus.$emit('onFileSelected',file);
        this.getImage(file);
      },
      getImage(file){
        let reader = new FileReader();
        reader.onload = (e) => {
          let product = this.products[this.index];
          product.url_img = e.target.result;
          let obj = new Object;
          obj.product = product;
          obj.index = this.index;
          this.updateProductByIndex(obj)
        }
        reader.readAsDataURL(file);

      }
  }
}
</script>

<style lang="css" scoped>
</style>
