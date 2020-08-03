<template>
  <div>
    <div class="form-row">
      <h1 id="this-title" class="mb-8 font-bold text-3xl">Dashboard</h1>
      <p class="mb-12 leading-normal">Hey there! Welcome to Ping CRM, a demo app designed to help illustrate how <a class="text-indigo-500 underline hover:text-orange-600" href="https://github.com/inertiajs">Inertia.js</a> works.</p>
      <div>
        <inertia-link class="btn-indigo" href="/500">500 error</inertia-link>
        <inertia-link class="btn-indigo" href="/404">404 error</inertia-link>
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-4">
        <a href="" @click.prevent class="dashbox dash-1 pb-2 pt-0">
          <i class="fa fa-users fa-3x d-block mx-auto py-2"></i>
          <div class="mt-2">
            <h3 class="mb-0 text-3xl">Users</h3>
            <p class="mb-0">101</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="" @click.prevent class="dashbox dash-2 pb-2 pt-0">
          <i class="fa fa-cubes fa-3x d-block mx-auto py-2"></i>
          <div class="mt-2">
            <h3 class="mb-0 text-3xl">Categories</h3>
            <p class="mb-0">224</p>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="" @click.prevent class="dashbox dash-3 pb-2 pt-0">
          <i class="fa fa-envelope fa-3x d-block mx-auto py-2"></i>
          <div class="mt-2">
            <h3 class="mb-0 text-3xl">SMS</h3>
            <p class="mb-0">1209</p>
          </div>
        </a>
      </div>
      <div class="col-md-4 d-none">
        <a href="" @click.prevent class="dashbox dash-4 pb-2 pt-0">
          <i class="fa fa-star fa-3x d-block mx-auto py-2"></i>
          <div class="mt-2">
            <h3 class="mb-0 text-3xl">Stars</h3>
            <p class="mb-0">812</p>
          </div>
        </a>
      </div>
    </div>

    <hr class="mb-3">

    <div class="form-row">
      <div class="col-md-3">
        <a href="" @click.prevent class="dashbox dash-12 py-0 d-flex text-left">
          <i class="fa fa-users fa-4x p-3 justify-content-center align-content-center"></i>
          <span class="mb-0 w-100 py-2 px-2">
            <h3 class="mb-0 text-3xl">Users</h3>
            <p class="mb-0">101</p>
          </span>
        </a>
      </div>
      <div class="col-md-3">
        <a href="" @click.prevent class="dashbox dash-11 py-0 d-flex text-left">
          <i class="fa fa-cubes fa-4x p-3 justify-content-center align-content-center"></i>
          <span class="mb-0 w-100 py-2 px-2">
            <h3 class="mb-0 text-3xl">Categories</h3>
            <p class="mb-0">224</p>
          </span>
        </a>
      </div>
      <div class="col-md-3">
        <a href="" @click.prevent class="dashbox dash-10 py-0 d-flex text-left">
          <i class="fa fa-envelope fa-4x p-3 justify-content-center align-content-center"></i>
          <span class="mb-0 w-100 py-2 px-2">
            <h3 class="mb-0 text-3xl">SMS</h3>
            <p class="mb-0">1209</p>
          </span>
        </a>
      </div>
      <div class="col-md-3">
        <a href="" @click.prevent class="dashbox dash-9 py-0 d-flex text-left">
          <i class="fa fa-star fa-4x p-3 justify-content-center align-content-center"></i>
          <span class="mb-0 w-100 py-2 px-2">
            <h3 class="mb-0 text-3xl">Stars</h3>
            <p class="mb-0">812</p>
          </span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

import { store } from '@/store';

export default {
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  mounted() {
    store.state.broadcom = [
      { title: 'Dashboard', url: '' },
    ];
  },
};
</script>
