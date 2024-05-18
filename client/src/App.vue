<template>
  <div
    class="h-screen w-screen"
    :class="$store.state.authUser.dark_mode == 1 ? 'dark-mode' : 'bg-gray-100'"
  >
    <Navbar />
    <router-view />
    <Footer />
  </div>
</template>

<script>
import Navbar from "./components/layouts/Navbar.vue";
import Footer from "./components/layouts/Footer.vue";
import axios from "axios";

export default {
  components: {
    Navbar,
    Footer,
  },

  mounted() {
    axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${localStorage.getItem("token")}`;

    setTimeout(() => {
      this.$store.state.isPageLoading = false;
    }, 2000);
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.dark-mode {
  background-color: #202020;
}
.loading-spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
