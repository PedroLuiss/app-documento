<template>
  <div v-if="$store.state.isPageLoading" class="fixed inset-0 z-50 bg-white">
    <div class="loading-spinner w-32 h-32 mx-auto my-96"></div>
  </div>
  <div v-else class="container bg-gray-200 p-3" style="margin: 1px auto">
    <div class="text-center p-2">
      <h3 class="mb-3">Lista de documento</h3>
      <div class="w-100">
        <div>
          <div class="input-group ">
            <input  class="form-control" type="text" v-model="searchQuery" placeholder="Buscar">
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header text-end">
        <button
          @click="goAddDocument()"
          class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Nuevo
        </button>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">CÓDIGO</th>
              <th scope="col">NOMBRE</th>
              <th scope="col">CONTENIDO</th>
              <th scope="col">TIPO</th>
              <th scope="col">PROCESO</th>
              <th scope="col" style="width: 10%"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredItems" :key="item.id">
              <th scope="row">{{ item.id }}</th>
              <td>{{ item.doc_codigo }}</td>
              <td>{{ item.doc_nombre }}</td>
              <td>{{ item.doc_contenido }}</td>
              <td>{{ item.doc_tipo }}</td>
              <td>{{ item.doc_proceso }}</td>
              <td>
                <button
                  @click="editDocumetnr(item.id)"
                  type="button"
                  class="btn btn-primary btn-sm bg-primary mr-2"
                >
                  Editar
                </button>
                <button
                  @click="deleteDocumetnr(item.id)"
                  type="button"
                  class="btn btn-danger btn-sm bg-danger"
                >
                  Eliminar
                </button>
              </td>
            </tr>
            <tr v-if="filteredItems.length<=0">
              <td colspan="7"><p class="text-center"> Sin Información</p></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
  
  <script>
import axios from "axios";
export default {
  created() {
    this.getDocument();
  },
  data: () => {
    return {
      items: [],
      searchQuery: ''
    };
  },
  computed: {
    filteredItems() {
      return this.items.filter(item => {
        return (
          item.doc_codigo.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          item.doc_nombre.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
          item.doc_contenido.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
          item.doc_tipo.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          item.doc_proceso.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      });
    }
  },
  methods: {
    goAddDocument() {
      console.log("Hola");
      this.$router.push({ name: "documentoAdd" });
    },
    editDocumetnr(id) {
      console.log(id);
      // const editLink = this.editLink(id);
      this.$router.push({ name: "documentoEdit", params: { id } });
    },
    getDocument() {
      let self = this;
      let listado = [];
      self.$store.state.isPageLoading = true;
      axios
        .get(self.$store.state.apiAdress+"/api/document/list", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then(function (response) {
          listado = response.data;
          console.log(listado);
          self.items = listado.map((listado) =>
            Object.assign({}, self.items, {
              id: listado.id,
              doc_nombre: listado.doc_nombre,
              doc_contenido: listado.doc_contenido,
              doc_codigo:
                listado.doc_proceso.pro_prefijo +
                "-" +
                listado.doc_tipo.tip_prefijo +
                "-" +
                listado.doc_codigo,
              doc_tipo: listado.doc_tipo.tip_nombre,
              doc_proceso: listado.doc_proceso.pro_nombre,
            })
          );
          self.$store.state.isPageLoading = false;
        })
        .catch(function (error) {
          console.log(error);
          // self.$router.push({ path: "/login" });
          self.$store.state.isPageLoading = false;
        });
    },
    deleteDocumetnr(id) {
      var self = this;
      console.log(id);
      if (confirm("¿Estás seguro de que deseas eliminar este elemento?")) {
      axios
        .delete(self.$store.state.apiAdress+"/api/document/delet/" + id, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then(function (response) {
          const listado = response.data;
          console.log(listado);
          self.getDocument();
        })
        .catch(function (error) {
          console.log(error);
          // self.$router.push({ path: "/login" });
          self.$store.state.isPageLoading = false;
        });
      }
    },
  },
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
  