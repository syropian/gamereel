import Vue from "vue";
import Router from "vue-router";
// import VueFeatherIcon from "vue-feather-icon";
import Auth from "@/components/Auth/src";
import Login from "@/components/Auth/src/Login";
import Register from "@/components/Auth/src/Register";
import Forgot from "@/components/Auth/src/Forgot";

Vue.use(Router);
// Vue.use(VueFeatherIcon);

const router = new Router({
  mode: "history",
  routes: [
    {
      path: "*",
      redirect: "/auth/login"
    },
    {
      path: "/auth",
      name: "Auth",
      component: Auth,
      redirect: "/auth/login",
      children: [
        {
          path: "login",
          name: "Login",
          component: Login
        },
        {
          path: "register",
          name: "Register",
          component: Register
        },
        {
          path: "forgot",
          name: "Forgot",
          component: Forgot
        }
      ]
    }
  ]
});

// router.beforeEach((to, from, next) => {
//   const currentUser = firebase.auth().currentUser
//   const requiresAuth = to.matched.some(record => record.meta.requiresAuth)

//   if (requiresAuth && !currentUser) {
//     next('login')
//   } else if (!requiresAuth && currentUser) {
//     next('profile')
//   } else {
//     next()
//   }
// })

export default router;
