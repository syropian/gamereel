<template>
  <div class="dashboard w-screen h-screen overflow-hidden">
    <header class="bg-brand flex items-center px-8">
      <img class="block self-center h-12" src="/images/logo-new.svg">
    </header>
    <div class="sidebar bg-grey-darkest py-8 overflow-y-scroll">
      <Sidebar></Sidebar>
    </div>
    <div class="clips bg-grey-lighter p-8 overflow-y-scroll relative">
      <transition name="fade">
        <div class="absolute pin flex items-center justify-center" v-show="loading">
          <img src="/images/loader.svg" alt="Loading..." />
        </div>
      </transition>
      <div class="clips-list flex flex-wrap">
        <Clip v-for="clip in clips" :key="clip.gameClipId" :clipData="clip"></Clip>
      </div>
    </div>
  </div>
</template>
<script>
import 'lightcase/src/js/lightcase.js'
import 'lightcase/src/css/lightcase.css'
import 'lazysizes'
import Sidebar from './Sidebar'
import Clip from './Clip'
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'Dashboard',
  components: {
    Clip,
    Sidebar
  },
  data() {
    return {
      loading: true
    }
  },
  computed: {
    ...mapGetters(['user', 'clips'])
  },
  methods: {
    ...mapActions(['fetchUser', 'fetchXboxClips', 'fetchClips', 'fetchTags'])
  },
  watch: {
    clips() {
      setTimeout(() => {
        $('a[data-rel^=lightcase]').lightcase({
          video: {
            width: 800,
            height: 450
          }
        })
      }, 0)
    }
  },
  async created() {
    this.fetchTags()
    if (!Object.keys(this.user).length) {
      await this.fetchUser()
    }
    await this.fetchXboxClips()
    await this.fetchClips()
    this.loading = false
  }
}
</script>
<style lang="scss">
.lazyload,
.lazyloading {
  opacity: 0;
}
.lazyloaded {
  transition: opacity 150ms ease;
  opacity: 1;
}
.dashboard {
  display: grid;
  grid-template-columns: 280px 1fr;
  grid-template-rows: 72px 1fr;
  header {
    grid-column: 1 / 3;
  }
}
.clips-list {
  justify-content: space-evenly;
  position: relative;
}
</style>

