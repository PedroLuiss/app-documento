import { createStore } from "vuex";
import axios from "axios";

export default createStore({
  state: {
    //auth
    authUser: [],
    apiAdress: "http://127.0.0.1:8000",
    authenticated: localStorage.getItem("token") ? true : false,

    //css
    toggleRightNav: true,
    toggleDeleteModal: false,
    toggleSearchShow: false,
    isPageLoading: true,
  },
  getters: {},
  mutations: {
    //auth
    setUser(state, data) {
      state.authUser = data;
    },


  },
  actions: {
    fetchUser({ commit }) {
      console.log("fetchUser...");
      var self = this;
      axios
        .get(self.state.apiAdress+"/api/user")
        .then((response) => {
          console.log(response.data);
          commit("setUser", response.data);
        })
        .catch((error) => {
          if (error.response.status == 401) {
            localStorage.removeItem("token");
            window.location.href = "/login";
          }
        });
    },

    
  },
  modules: {},
});
