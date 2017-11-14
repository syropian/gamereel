import { Promise } from 'es6-promise'
import ls from 'local-storage'
import { SET_USER } from '../mutation-types'
import client from '../api/client'

const state = {
  user: {}
}

const getters = {
  user: state => state.user,
  isAuthenticated: state => !!ls('jwt')
}

const mutations = {
  [SET_USER](state, user) {
    state.user = user
  }
}

const actions = {
  fetchUser({ commit }) {
    return client
      .withAuth()
      .get('/api/auth')
      .then(res => {
        commit(SET_USER, res)
      })
  },
  register({ commit }, user) {
    return client
      .withoutAuth()
      .post('/api/users', user)
      .then(res => {
        ls('jwt', res.token)
        commit(SET_USER, res.user)
      })
  },
  login({ commit }, user) {
    return client
      .withoutAuth()
      .post('/api/auth', user)
      .then(res => {
        ls('jwt', res.token)
        commit(SET_USER, res.user)
      })
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
