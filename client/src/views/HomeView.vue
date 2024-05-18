<template>
  <div
    class="flex w-80 h-96 items-center justify-center mx-auto lg:my-44 lg:w-96 lg:h-122"
  >
    <div
      class="p-2 shadow-md rounded-md w-96 bg-white h-32 flex items-center justify-center"
    >
    <div>
       <h1 class="text-gray-500">Prueba Técnica Práctica PHP (Laravel + vue)</h1>
      <div class="text-center">
        <router-link
          class="mr-2 font-thin text-md hover:underline hover:underline-offset-4"
          to="/login"
          >Inicia Aquí</router-link
        >
      </div>
     </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HomeView",
};
</script>

<style scoped>
.h-122 {
  height: 52.3rem;
}
</style>
