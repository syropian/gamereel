import Vue from 'vue'
import App from './components/App'
import router from './router'
import store from './store'
import VueFeatherIcon from 'vue-feather-icon'

Vue.use(VueFeatherIcon)

Vue.config.productionTip = false

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})
