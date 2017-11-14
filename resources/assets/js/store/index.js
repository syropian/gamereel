import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user'
import clips from './modules/clips'
import tags from './modules/tags'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    user,
    clips,
    tags
  }
})
