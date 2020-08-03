<template>
  <div>
    <h1 id="this-title" class="mb-8 font-bold text-3xl">Posts</h1>
    <div class="mb-6 flex justify-between items-center">
      <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="mt-1 w-full form-select">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <inertia-link class="btn-indigo" :href="route('post.create')">
        <span>Create</span>
        <span class="hidden md:inline">Post</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <tr class="text-left font-bold bg-gray-100">
          <th class="px-6 pt-6 pb-4">Title</th>
          <th class="px-6 pt-6 pb-4">Body</th>
        </tr>
        <tr v-for="post in posts.data" :key="post.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link class="px-4 py-3 flex items-center focus:text-indigo-500" :href="route('posts.edit', post.id)">
              {{ post.title }}
              <icon v-if="post.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-4 py-3 flex items-center" :href="route('posts.edit', post.id)" tabindex="-1">
              {{ post.body }}
            </inertia-link>
          </td>
          <!-- <td class="border-t w-px">
            <inertia-link class="px-4 flex items-center" :href="route('posts.edit', post.id)" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td> -->
        </tr>
        <tr v-if="posts.data.length === 0">
          <td class="border-t px-4 py-3" colspan="4">No posts found.</td>
        </tr>
      </table>
    </div>
    <pagination :links="posts.links" />
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import pickBy from 'lodash/pickBy'
import SearchFilter from '@/Shared/SearchFilter'
import throttle from 'lodash/throttle'

import { store } from '@/store'

export default {
  metaInfo: { title: 'Posts' },
  layout: Layout,
  components: {
    Icon,
    Pagination,
    SearchFilter,
  },
  props: {
    posts: Object,
    filters: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  mounted(){
    store.state.broadcom = [
      { title: 'Posts', url: '' },
    ];
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('posts', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
};
</script>
