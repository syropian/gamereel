import Vue from "vue";
import Vuex from "vuex";
import user from "./modules/user";
import clips from "./modules/clips";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    user,
    clips
  }
});
