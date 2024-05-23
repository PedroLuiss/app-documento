<template>
    <div v-if="$store.state.isPageLoading" class="fixed inset-0 z-50 bg-white">
      <div class="loading-spinner w-32 h-32 mx-auto my-96"></div>
    </div>
    <div v-else class="container p-3" style="margin: 1px auto">
      <div class="card">
        <div class="card-header text-center p-3">
          <h1>Agregar Documento</h1>
        </div>
        <div class="card-body">
          <div v-if="alertS" class="alert alert-success" role="alert">
              {{ mensajes }}
          </div>
          <form action="#">
            <div class="row">
              <div class="con-md-12">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label"
                    >NOMBRE</label
                  >
                  <input
                    type="text"
                    v-model="data.doc_nombre"
                    class="form-control"
                    id="formGroupExampleInput"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label"
                    >TIPO</label
                  >
                  <select v-model="data.tip_tipo_doc_id" class="form-select" aria-label="Default select example">
                    <option  v-for="(iten) in tipo" :key="iten.id" :value="iten.value">{{iten.nombre}}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label"
                    >PROCESO</label
                  >
                  <select  v-model="data.pro_proceso_id" class="form-select" aria-label="Default select example">
                    <option  v-for="(iten) in proceso" :key="iten.id"  :value="iten.value">{{iten.nombre}}</option>
                  </select>
                </div>
              </div>
              <div class="con-md-12">
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label"
                    >CONTENIDO</label
                  >
                  <textarea
                  v-model="data.doc_contenido"
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
                  ></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-2">
              <button
                type="button"
                @click="update"
                class="btn btn-primary btn-sm bg-primary mr-2"
              >
                Guardar
              </button>
              <button
                type="button"
                @click="goListDocument"
                class="btn btn-secondary btn-sm bg-secondary"
              >
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
    
    <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        data: {
          id: "",
          doc_nombre: "",
          doc_contenido: "",
          tip_tipo_doc_id: "",
          pro_proceso_id: "",
        },
        mensajes: "",
        alertS: false,
        tipo:[],
        proceso:[],
      };
    },
    methods: {
      goListDocument() {
        this.$router.push({ name: "documentos" });
      },
      closeAlert() {
          var self = this;
          setTimeout(function() {
          // Código a ejecutar cada 2 minutos
          console.log('Ejecutando algo cada 2 minutos');
          self.mensajes = ""
          self.alertS = false
          }, 5000);
      },
      update() {
          console.log("update");
        var self = this;
        self.$store.state.isPageLoading = true;
        axios
          .post(self.$store.state.apiAdress+"/api/document/store",self.data,{
              headers: {
              Authorization: "Bearer "+localStorage.getItem("token"),
            }  
          })
          .then(function (response) {
  
            console.log(response.data);
            self.mensajes = response.data.message
            self.alertS = true
            self.closeAlert()
            self.$store.state.isPageLoading = false;
          })
          .catch(function (error) {
            if (error.response.status === 422) {
              console.log("Error 422 - Unprocessable Entity");
              console.log(error.response.data); // Aquí se muestra el error en formato JSON
              for (let key in error.response.data.errors) {
                  if (Array.isArray(error.response.data.errors[key])) {
                      // console.log(`Mensajes de error para ${key}:`);
                      error.response.data.errors[key].forEach((mensaje, index) => {
                      console.log(`${index + 1}. ${mensaje}`);

                     

                      });
                  }
              }
        
            } else {
              console.log("Error");
              // self.$toastr.danger("¡Error al agregar producto!");
            }
            self.$store.state.isPageLoading = false;
          });
      },
      getTipo() {
        let self = this;
        let listado = [];
        self.$store.state.isPageLoading = true;
        axios
          .get(self.$store.state.apiAdress+"/api/document/tipo/list", {
            headers: {
              Authorization: "Bearer "+localStorage.getItem("token"),
            },
          })
          .then(function (response) {
            listado = response.data;
            console.log(listado);
            self.tipo = listado.map((listado) =>
              Object.assign({}, self.tipo, {
                value: listado.id,
                nombre: listado.tip_nombre,
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
      getProceso() {
        let self = this;
        let listado = [];
        self.$store.state.isPageLoading = true;
        axios
          .get(self.$store.state.apiAdress+"/api/document/proceso/list", {
            headers: {
              Authorization: "Bearer "+localStorage.getItem("token"),
            },
          })
          .then(function (response) {
            listado = response.data;
            console.log(listado);
            self.proceso = listado.map((listado) =>
              Object.assign({}, self.proceso, {
                value: listado.id,
                nombre: listado.pro_nombre,
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
      getDocument(id) {
        let self = this;
        let listado = [];
        self.$store.state.isPageLoading = true;
        axios
          .get(self.$store.state.apiAdress+"/api/document/edit/"+id, {
            headers: {
              Authorization: "Bearer "+localStorage.getItem("token"),
            },
          })
          .then(function (response) {
            console.log("getDocument");
            const dataResp = response.data;
            console.log(dataResp);
            self.data.id = dataResp.id
            self.data.doc_nombre = dataResp.doc_nombre
            self.data.doc_contenido = dataResp.doc_contenido
            self.data.tip_tipo_doc_id = dataResp.tip_tipo_doc_id
            self.data.pro_proceso_id = dataResp.pro_proceso_id
            self.$store.state.isPageLoading = false;
          
          })
          .catch(function (error) {
            console.log(error);
            // self.$router.push({ path: "/login" });
            self.$store.state.isPageLoading = false;
          });
      },
    },
    created() {
      console.log("Creado component");
      this.getTipo();
      this.getProceso();
      this.getDocument(this.$route.params.id);
      this.$store.dispatch("fetchUser");
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
    