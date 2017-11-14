<template>
  <div class="clip flex flex-col bg-white rounded shadow mb-8 mr-8" v-show="visible">
    <a class="block" :href="clipData.gameClipUris[0].uri" data-rel="lightcase:clips">
      <img :data-src="clipData.thumbnails[0].uri" class="rounded rounded-t lazyload" />
    </a>
    <div class="p-4 flex flex-col flex-grow">
      <h4 class="text-grey-darker">{{ clipData.titleName }}</h4>
      <p v-if="clipData.clipName">{{ clipData.clipName }}</p>
      <div class="clip-tags">
        <multiselect 
          :value="tags"
          v-show="editingTags" 
          :options="tagList"
          :multiple="true" 
          :taggable="true"
          :close-on-select="false"
          :preserve-search="true"
          :hide-selected="true"
          :placeholder="'Add a tag'"
          track-by="name"
          label="name"
          @tag="addTag"
          @input="syncTags"
        >
          <template slot="caret" slot-scope="props"><span style="display:none;"></span></template>
        </multiselect>
      </div>
      <div class="flex justify-between items-center mt-auto text-grey-darker">
        <div class="flex items-center">
          <feather-icon type="heart" class="mr-2 fill-none stroke-current relative nudge-t" width="16"></feather-icon>
          <span>{{clipData.likeCount}}</span>
        </div>
        <div class="flex items-center">
          <feather-icon type="message-square" class="mr-2 fill-none stroke-current relative nudge-t" width="16"></feather-icon>
          <span>{{clipData.commentCount}}</span>
        </div>
        <div class="flex items-center">
          <feather-icon type="share-2" class="mr-2 fill-none stroke-current relative nudge-t" width="16"></feather-icon>
          <span>{{clipData.shareCount}}</span>
        </div>
        <button class="bg-brand hover:bg-purple text-white text-xs cursor-pointer py-2 px-3 inline-flex items-center transition-bg">
          <feather-icon type="download-cloud" class="mr-2 fill-none stroke-current relative nudge-t w-4 h-4"></feather-icon>
          <span>Save</span>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import { mapActions, mapGetters } from 'vuex'
import { differenceBy } from 'lodash'
export default {
  name: 'Clip',
  components: { Multiselect },
  props: ['clipData'],
  data() {
    return {
      tags: [],
      tagList: [],
      editingTags: true
    }
  },
  computed: {
    ...mapGetters({
      userTags: 'tags',
      currentGame: 'currentGame',
      currentTag: 'currentTag'
    }),
    clipFromCurrentGame() {
      if (!this.currentGame) {
        return true
      }
      return this.clipData.titleName === this.currentGame
    },
    clipHasCurrentTag() {
      if (!Object.keys(this.currentTag).length) {
        return true
      }
      return this.clipData.tags.map(c => c.name).includes(this.currentTag.name)
    },
    visible() {
      return this.clipFromCurrentGame && this.clipHasCurrentTag
    }
  },
  watch: {
    clipData: {
      handler(newData) {
        this.tags = newData.tags
      },
      deep: true,
      immediate: true
    },
    userTags: {
      handler(newData) {
        this.tagList = newData
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    ...mapActions(['syncClipTags', 'fetchTags']),
    async addTag(newTag) {
      const tag = {
        name: newTag,
        id: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
      }
      this.tags.push(tag)
      this.tagList.push(tag)
      await this.syncClipTags({ id: this.clipData.gameClipId, tags: this.tags })
      this.fetchTags()
    },
    async syncTags(value, id) {
      await this.syncClipTags({ id: this.clipData.gameClipId, tags: value })
      this.fetchTags()
    }
  }
}
</script>
<style>
.clip {
  width: 300px;
  min-height: 300px;
}
</style>
