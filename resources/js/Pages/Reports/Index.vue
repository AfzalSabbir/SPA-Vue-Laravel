<template>
  <div>
    <h1 id="this-title" class="mb-8 font-bold text-3xl">Reports</h1>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

import { store } from '@/store'

export default {
  metaInfo: { title: 'Reports' },
  layout: Layout,
  mounted() {
    store.state.broadcom = [
      { title: 'Reports', url: '' },
    ];
  },
};
</script>
