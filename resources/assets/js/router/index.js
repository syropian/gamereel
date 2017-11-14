import Vue from 'vue'
import Router from 'vue-router'
import ls from 'local-storage'
// import VueFeatherIcon from "vue-feather-icon";
import Auth from '@/components/Auth'
import Login from '@/components/Auth/Login'
import Register from '@/components/Auth/Register'
import Forgot from '@/components/Auth/Forgot'
import Dashboard from '@/components/Dashboard'

Vue.use(Router)
// Vue.use(VueFeatherIcon);

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '*',
      redirect: '/auth/login'
    },
    {
      path: '/auth',
      name: 'Auth',
      component: Auth,
      redirect: '/auth/login',
      children: [
        {
          path: 'login',
          name: 'Login',
          component: Login
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        },
        {
          path: 'forgot',
          name: 'Forgot',
          component: Forgot
        },
        {
          path: 'logout',
          name: 'Logout',
          meta: {
            requiresAuth: true
          },
          beforeEnter: (to, from, next) => {
            ls.remove('jwt')
            next('auth/login')
          }
        }
      ]
    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: Dashboard,
      meta: {
        requiresAuth: true
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  const token = ls('jwt')
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth)

  if (requiresAuth && !token) {
    next('auth/login')
  } else if (!requiresAuth && token) {
    next('dashboard')
  } else {
    next()
  }
})

export default router
