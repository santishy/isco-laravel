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
          console.log('upload-index:' + this.index)
          let product = this.products[this.index];
          product.url_img = e.target.result;
          this.updateProductByIndex(product,this.index)
        }
        reader.readAsDataURL(file);

      }
  }
}
</script>

<style lang="css" scoped>
</style>
