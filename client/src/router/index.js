import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

import Login from "../components/auth/Login.vue";
import Dashboard from "../components/auth/Dashboard.vue";
import Documentos from "../components/documento/DocList.vue";
import DocumentosForm from "../components/documento/AddDocument.vue";
import DocumentosFormEdit from "../components/documento/EditDocument.vue";


const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
    meta: {
      requiresGuest: true,
    },
  },
  {
    path: "/login",
    name: "login",
    component: Login,
    meta: {
      requiresGuest: true,
    },
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: "/documentos",
    name: "documentos",
    component: Documentos,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: "/documentos/add",
    name: "documentoAdd",
    component: DocumentosForm,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: "/documentos/:id/edit",
    name: "documentoEdit",
    component: DocumentosFormEdit,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: "/:catchAll(.*)",
    component: () => import("../components/NotFound.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem("token") !== null;
  // const isAuthenticated = "sfndmlkndsfknklads";

  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      next("/login");
    } else {
      next();
    }
  } else if (to.matched.some((record) => record.meta.requiresGuest)) {
    if (isAuthenticated) {
      next("/dashboard");
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
