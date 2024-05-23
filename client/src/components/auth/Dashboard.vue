<template>
  <div v-if="$store.state.isPageLoading" class="fixed inset-0 z-50 bg-white">
    <div class="loading-spinner w-32 h-32 mx-auto my-96"></div>
  </div>
  <div
    v-else
    class="flex w-80 h-96 items-center justify-center mx-auto lg:my-44 lg:w-96 lg:h-122"
  >
    <div
      class="p-2 shadow-md rounded-md w-96 h-32 flex items-center justify-center bg-white text-gray-500"
     
    >
      <router-link class="mr-2 font-thin text-md hover:underline hover:underline-offset-4 h3" to="/documentos">Lista De Documento</router-link>

   
    </div>
  </div>
</template>

<script>
export default {
  created() {
    console.log("Creado");
   
  },
  mounted(){
    this.$store.dispatch("fetchUser");
  }
};
</script>
<style scoped>
.h-122 {
  height: 52.3rem;
}
.dark-mode {
  background-color: #121212;
}
</style>
