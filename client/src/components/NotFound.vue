<template>
  <div
    class="w-1/2 mx-auto flex items-center justify-center h-44 my-72"
    :class="
      $store.state.authUser.dark_mode == 1
        ? 'dark-mode text-gray-200'
        : 'text-gray-400'
    "
  >
    <div
      class="text-xl font-thin uppercase px-4 border-r-2 border-gray-300 tracking-wider"
    >
      404
    </div>
    <div class="text-xl font-thin uppercase ml-4 tracking-wider">NOT FOUND</div>
  </div>
</template>

<script>
export default {
  created() {
    this.$store.dispatch("fetchUser");
  },
};
</script>

<style scoped>
.dark-mode {
  background-color: #202020;
}
</style>
