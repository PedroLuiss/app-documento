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
      axios
        .get(this.apiAdress+"/api/user")
        .then((response) => {
          commit("setUser", response.data.user);
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
