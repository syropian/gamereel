import { Promise } from 'es6-promise'
import { SET_CLIPS } from '../mutation-types'

import client from './../api/client.js'

const state = {
  clips: []
}

const getters = {
  clips: state => state.clips
}

const mutations = {
  [SET_CLIPS](state, clips) {
    state.clips = clips
  }
}

const actions = {
  fetchClips({ commit }) {
    return new Promise((resolve, reject) => {
      client
        .withAuth()
        .get('/api/clips')
        .then(res => {
          commit(SET_CLIPS, res.data)
          resolve(res.data)
        })
        .catch(error => {
          reject(error)
        })
    })
  },
  fetchXboxClips({ commit }, gamertag) {
    return client
      .withAuth()
      .get(`/api/clips/${gamertag}`)
      .then(res => {
        commit(SET_CLIPS, res.clips)
      })
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
