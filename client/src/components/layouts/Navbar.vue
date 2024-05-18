<template>
  <nav
    class="flex justify-between items-center h-16 shadow-sm text-gray-500 relative bg-white border-b-2 border-gray-100"
   
  >
    <div class="ml-3 font-thin text-md">
      <div v-if="!authenticated">
        <router-link to="/">Sistema de documento</router-link>
      </div>
      <div v-else>
        <p>Bienvenido </p>
      </div>
    </div>
    <div class="mr-4">
      <div v-if="!authenticated">
        <router-link
          class="mr-2 font-thin text-md hover:underline hover:underline-offset-4"
          to="/login"
          >Login</router-link
        >
       
      </div>
      <div v-else class="">
        <router-link to="/dashboard" class="mr-4">
          <span
            class="font-thin text-md hover:underline hover:underline-offset-4"
            >Dashboard</span
          >
        </router-link>
    
        <span
          class="cursor-pointer bg-red-500 text-white dot text-center hover:bg-red-400"
          @click="isShow = !isShow"
        >
          A
        </span>
      </div>
      <div
        v-show="isShow"
        class="absolute z-50 mt-2 w-44 rounded-md shadow-lg origin-top-right right-0 pop"
      >
        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
          <div class="block px-4 py-2 text-xs text-gray-400">
            Menú
          </div>
         
          <div class="border-t border-gray-200"></div>
          <button
            class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
            @click="logOut"
          >
            Cerrar Sesión
          </button>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import axios from "axios";
import { mapState } from "vuex";
export default {
  data() {
    return {
      isShow: false,
    };
  },
  computed: {
    ...mapState(["authenticated", "authUser"]),
  },
  methods: {
    logOut() {
      axios
        .post("http://127.0.0.1:8000/api/v2/logout")
        .then((response) => {
          localStorage.removeItem("token");
          window.location.href = "/";
        })
        .catch((error) => {
          if (error.response.status == 401) {
            localStorage.removeItem("token");
            window.location.href = "/login";
          }
        });
    },
    
  },
};
</script>

<style scoped>
.dot {
  height: 25px;
  width: 25px;
  border-radius: 50%;
  display: inline-block;
  text-align: center;
}
.dark-mode {
  background-color: #121212;
}
@keyframes pop {
  0% {
    transform: scaleY(0);
  }
  100% {
    transform: scaleY(1);
  }
}
.pop {
  animation: pop 0.5s ease-in-out forwards;
}
</style>
