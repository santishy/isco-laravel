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
export default {
  data(){
    return {
      hasError:{},
      form:{}
    }
  },
  methods:{
    onFileSelected(event){
        let file = event.target.files[0];
        this.form.image = file;
        EventBus.$emit('onFileSelected',file);
        // for(let i=0;i<event.target.files.length;i++){
        //   this.attachments.push(event.target.files[i])
        // }
      }
  }
}
</script>

<style lang="css" scoped>
</style>
