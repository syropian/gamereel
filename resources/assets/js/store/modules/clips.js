import { Promise } from 'es6-promise'
import {
  SET_CURRENT_GAME,
  SET_CLIPS,
  SYNC_CLIP_TAGS,
  UPDATE_CLIP,
  MAP_USER_CLIPS_TO_XBOX_CLIPS
} from '../mutation-types'

import client from './../api/client.js'

const state = {
  clips: [],
  currentGame: ''
}

const getters = {
  clips: state => state.clips,
  games: state =>
    state.clips
      .map(clip => clip.titleName)
      .filter((title, pos, arr) => arr.indexOf(title) === pos),
  currentGame: state => state.currentGame
}

const mutations = {
  [SET_CLIPS](state, clips) {
    state.clips = clips
  },
  [SET_CURRENT_GAME](state, game) {
    state.currentGame = game
  },
  [SYNC_CLIP_TAGS](state, { uuid, tags }) {
    const index = state.clips.findIndex(clip => clip.gameClipId === uuid)
    if (index > -1) {
      state.clips[index].tags = tags
    }
  },
  [MAP_USER_CLIPS_TO_XBOX_CLIPS](state, userClips) {
    userClips.forEach(userClip => {
      const index = state.clips.findIndex(
        clip => clip.gameClipId === userClip.uuid
      )
      if (index > -1) {
        state.clips[index].tags = userClip.tags
      }
    })
  }
}

const actions = {
  fetchXboxClips({ commit }) {
    return client
      .withAuth()
      .get('/api/xbox-clips')
      .then(res => {
        commit(SET_CLIPS, res.clips)
      })
  },
  fetchClips({ commit }) {
    return client
      .withAuth()
      .get('/api/clips')
      .then(res => {
        commit(MAP_USER_CLIPS_TO_XBOX_CLIPS, res)
      })
  },
  syncClipTags({ commit }, { id, tags }) {
    return client
      .withAuth()
      .put(`/api/clip/tags`, { id, tags })
      .then(res => {
        commit(SYNC_CLIP_TAGS, res.clip)
      })
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
