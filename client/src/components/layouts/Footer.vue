<template>
  <footer
    class="fixed w-screen bottom-0 md:h-16 md:flex md:justify-evenly shadow-lg"
    :class="
      $store.state.authUser.dark_mode == 1
        ? 'dark-mode text-gray-100 border-t-4 border-black'
        : 'bg-white text-gray-500 border-t-2 border-gray-100'
    "
  >
  </footer>
</template>

<style scoped>
.dark-mode {
  background-color: #121212;
}
</style>
