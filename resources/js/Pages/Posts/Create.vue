<template>
  <div>
    <h1 id="this-title" class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('posts')">Posts</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.title" :errors="$page.errors.title" class="pr-6 pb-8 w-full" label="Title" />
          <textarea-input v-model="form.body" :errors="$page.errors.body" class="pr-6 pb-8 w-full" label="Body" rows="4" ></textarea-input>
        </div>
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
          <loading-button :loading="sending" class="btn-indigo" type="submit">Post</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextareaInput'

import { store } from '@/store'

export default {
  metaInfo: { title: 'Post' },
  layout: Layout,
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput,
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        title: null,
        body: null,
      },
    }
  },
  mounted() {
    store.state.broadcom = [
      { title: 'Posts', url: route('posts') },
      { title: 'Create', url: '' },
    ];
  },
  methods: {
    submit() {
      this.sending = true
      this.$inertia.post(this.route('post.store'), this.form)
        .then(() => this.sending = false)
    },
  },
};
</script>
