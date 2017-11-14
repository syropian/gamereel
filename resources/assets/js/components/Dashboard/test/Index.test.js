import Vuex from 'vuex'
import { shallow, createLocalVue } from 'vue-test-utils'
import { createRenderer } from 'vue-server-renderer'
import Index from '../Index.vue'
import $ from 'jquery'
import 'lightcase/src/js/lightcase.js'
import 'lightcase/src/css/lightcase.css'

jest.mock('lightcase/src/js/lightcase.js', () => jest.fn())
jest.mock('lightcase/src/css/lightcase.css', () => jest.fn())

const localVue = createLocalVue()
localVue.use(Vuex)

describe('Dashboard Index Component', () => {
  let wrapper, store, getters, actions
  beforeEach(() => {
    getters = {
      user: () => {
        gamertag: 'Syro'
      },
      clips: () => []
    }
    actions = {
      fetchUser: jest.fn(),
      fetchXboxClips: jest.fn(),
      fetchClips: jest.fn(),
      fetchTags: jest.fn()
    }
    store = new Vuex.store({ getters })
    wrapper = shallow(Index, {
      stubs: ['Clip'],
      store,
      localVue
    })
  })
  it('dispatches the actions to get the initial data', () => {
    expect(actions.fetchTags.mock.calls).toHaveLength(1)
  })
})
