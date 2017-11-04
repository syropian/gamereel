import Vue from "vue";
import App from "./components/App/src";
import router from "./router";
import store from "./store/src";

Vue.config.productionTip = false;

new Vue({
  el: "#app",
  router,
  store,
  render: h => h(App)
});
