<template>
<div class="sidebar bg-grey-darkest py-8">
  <h4 class="text-grey-darker text-sm uppercase mb-4 pl-4 tracking-wider">Games</h4>
  <ul class="games list-reset text-grey">
    <li 
    class="border-l-4 border-grey-darkest py-3 px-4 truncate cursor-pointer hover:text-grey-light"
    :class="{'text-purple-light border-purple-light hover:text-purple-light bg-black': currentGame === ''}"
    @click="setCurrentGame('')">All Games</li>
    <li 
      v-for="title in games" 
      :key="title" 
      class="border-l-4 border-grey-darkest py-3 px-4 truncate cursor-pointer hover:text-grey-light" 
      @click="setCurrentGame(title)" 
      :class="{'text-purple-light border-purple-light hover:text-purple-light bg-black': currentGame === title}">
      {{ title }}
    </li>
  </ul>
  <div class="flex justify-between items-center px-4 mt-8 mb-4">
    <h4 class="text-grey-darker text-sm uppercase tracking-wider">Tags</h4>
    <button 
      class="bg-transparent text-grey hover:text-grey-light hover:bg-black rounded px-2 py-1"
      v-show="Object.keys(currentTag).length"
      @click="setCurrentTag({})"
    >
    &times;
    </button>
  </div>
  <ul class="tags list-reset text-grey">
    <li 
      class="flex items-center border-l-4 border-grey-darkest py-3 px-4 truncate cursor-pointer hover:text-grey-light"
      :class="{'text-purple-light border-purple-light hover:text-purple-light bg-black': tag.name === currentTag.name}"
      v-for="tag in tags"
      :key="tag.id"
      @click="setCurrentTag(tag)"
    >
    <feather-icon type="tag" class="sidebar-icon mr-2 fill-none stroke-current relative" width="18"></feather-icon>
    <span>{{ tag.name }}</span>
    <span 
      class="ml-auto text-grey-light bg-grey-darker rounded-full px-3 py-1 text-xs" 
      :class="{'bg-purple text-white': tag.name === currentTag.name}"
      v-show="tag.clips_count > 0"
    >
      {{ tag.clips_count }}
    </span>
    </li>
  </ul>
</div>
</template>
<script>
import { mapGetters, mapMutations } from 'vuex'
export default {
  name: 'Sidebar',
  computed: {
    ...mapGetters(['games', 'currentGame', 'tags', 'currentTag'])
  },
  methods: {
    ...mapMutations({
      setCurrentGame: 'SET_CURRENT_GAME',
      setCurrentTag: 'SET_CURRENT_TAG'
    })
  }
}
</script>
<style>
.sidebar-icon {
  top: 2px;
}
</style>
