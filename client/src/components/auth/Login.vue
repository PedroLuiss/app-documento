<template>
  <div
    class="flex flex-col h-96 sm:justify-center items-center sm:pt-0 bg-gray-100 h-122 lg:my-32 lg:pt-6"
  >
    <div
      class="w-full my-11 sm:max-w-md px-6 py-4 bg-white shadow-lg overflow-hidden sm:rounded-lg lg:mt-6"
    >
      <div class="mb-4" v-show="alreadyTaken">
        <div class="font-medium text-red-600">
          ¡Vaya! Algo salió mal.
        </div>
        <ul class="mt-3 list-inside text-sm text-red-600">
          <li class="ml-1.5">Estas credenciales no coinciden con nuestros registros.</li>
        </ul>
      </div>
      <div class="mb-4" v-show="emptyField">
        <div class="font-medium text-red-600">
          ¡Vaya! Algo salió mal.
        </div>
        <ul class="mt-3 list-inside text-sm text-red-600">
          <li class="ml-1.5">Por favor complete los campos vacíos.</li>
        </ul>
      </div>
      <form @submit.prevent="submitForm">
        <div class="py-5">
          <h1
            class="text-xl uppercase font-bold text-center tracking-widest text-gray-500"
          >
            Login
          </h1>
        </div>
        <div class="mt-4">
          <label
            class="block font-medium text-sm text-gray-700 tracking-wide"
            for="email"
          >
            Correo
          </label>
          <input
            class="border-gray-400 border-2 p-2 focus:outline-blue-500 rounded-md shadow-sm block mt-1 w-full"
            id="email"
            type="email"
            name="email"
            required="required"
            autofocus="autofocus"
            autocomplete="username"
            v-model="formValues.email"
          />
        </div>

        <div class="mt-4">
          <label
            class="block font-medium text-sm text-gray-700 tracking-wide"
            for="password"
          >
            Contraseña
          </label>
          <input
            class="border-gray-400 border-2 p-2 focus:outline-blue-500 rounded-md shadow-sm block mt-1 w-full"
            id="password"
            type="password"
            name="password"
            required="required"
            autocomplete="current-password"
            v-model="formValues.password"
          />
        </div>

        <div class="flex items-center justify-end mt-4">

          <button
            type="submit"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4"
          >
            Iniciar Sesión
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      formValues: {
        email: "admin@gmail.com",
        password: "admin123",
      },
      alreadyTaken: false,
      emptyField: false,
      minPass: false,
    };
  },
  methods: {
    submitForm() {
      var self = this;
      console.log("Hola");
      axios
        .post( self.$store.state.apiAdress +"/api/v2/login", this.formValues)
        .then((response) => {
          localStorage.setItem("token", response.data.access_token);
          window.location.href = "/dashboard";
        })
        .catch((err) => {
          if (err.response) {
            this.emptyField = true;
            setTimeout(() => {
              this.emptyField = false;
            }, 3000);
          }
          if (
            this.formValues.email == "" ||
            this.formValues.password == ""
          ) {
            this.emptyField = true;
            setTimeout(() => {
              this.emptyField = false;
            }, 3000);
          } else if (err.response.status == 500) {
            this.alreadyTaken = true;
            setTimeout(() => {
              this.alreadyTaken = false;
            }, 3000);
          }
        });
    },
  },
};
</script>

<style scoped>
@media (min-width: 1024px) {
  .h-122 {
    height: 31.5rem;
  }
}
</style>
