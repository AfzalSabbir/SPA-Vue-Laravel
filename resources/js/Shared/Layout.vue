<template>
  <div>
    <portal-target name="dropdown" slim />
    <div class="flex flex-col">
      <div class="h-screen flex flex-col" @click="hideDropdownMenus">
        <!-- NavBar -->
        <div class="md:flex flex-shrink-0">
          <div class="bg-indigo-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center cursor-pointer app-nav" @click="toggleSideBar">
            <inertia-link class="mt-1" href="#" @click.prevent="">
              <svg v-if="showSmallSideBar" class="fill-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
              <!-- <logo v-else class="fill-white" width="120" height="28" /> -->
              <span v-else class="fill-white text-white text-3xl font-bold">AdminPanel</span>
            </inertia-link>

            <dropdown class="md:hidden" placement="bottom-end">
              <svg class="fill-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
              <div slot="dropdown" class="mt-2 px-8 py-4 shadow-lg bg-indigo-800 rounded">
                <side-bar :url="url()" />
              </div>
            </dropdown>
          </div>
          <!-- Broadcom -->
          <div class="bg-white border-b w-full py-2 px-4 md:py-0 md:px-4 text-sm md:text-md flex justify-between items-center">
            <p class="mr-4 font-bold text-xl">
              <span v-for="item in broadcom">
                <span v-if="item.url">
                  <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="item.url">{{ item.title }}</inertia-link><span class="text-indigo-400 font-medium"> / </span>
                </span>
                <span v-else>{{ item.title }}</span>
              </span>
            </p>
            <dropdown class="" placement="bottom-end">
              <div class="flex items-center cursor-pointer select-none group">
                <div class="text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 mr-1 whitespace-no-wrap">
                  <span>{{ $page.auth.user.first_name }}</span>
                  <span class="hidden md:inline">{{ $page.auth.user.last_name }}</span>
                </div>
                <icon class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600" name="cheveron-down" />
              </div>
              <div slot="dropdown" class="mt-2 py-2 shadow-xl bg-white rounded text-sm">
                <inertia-link class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" :href="route('users.edit', $page.auth.user.id)">My Profile</inertia-link>
                <inertia-link class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" :href="route('users')">Manage Users</inertia-link>
                <inertia-link class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" :href="route('logout')" method="post">Logout</inertia-link>
              </div>
            </dropdown>
          </div>
        </div>
        <div class="flex flex-grow overflow-hidden">

          <!-- Side-Bar -->
          <side-bar :url="url()" v-if="showSideBar" class="bg-indigo-800 flex-shrink-0 w-56 px-2 hidden md:block overflow-y-auto" />

          <!-- Main Body -->
          <div class="flex-1 px-4 py-8 md:p-4 overflow-y-auto" scroll-region>
            <flash-messages />
            <slot />
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import Dropdown from '@/Shared/Dropdown'
import FlashMessages from '@/Shared/FlashMessages'
import Icon from '@/Shared/Icon'
import Logo from '@/Shared/Logo'
import SideBar from '@/Shared/SideBar'
import { store } from '@/store';

export default {
  components: {
    Dropdown,
    FlashMessages,
    Icon,
    Logo,
    SideBar,
  },
  data() {
    return {
      showUserMenu: false,
      accounts: null,
      showSideBar: true,
      showSmallSideBar: false,
      broadcom: '',
    }
  },
  methods: {
    url() {
      this.broadcom = store.state.broadcom;
      
      if (_.split(location, 'localhost:')[1]) {
        return location.pathname.substr(1);
      } else {
        return _.toString(_.slice(_.split(location.pathname, '/'), 2));
      }
    },
    toggleSideBar() {
      this.showSideBar = !this.showSideBar;
    },
    hideDropdownMenus() {
      this.showUserMenu = false
    },
  },
};
</script>
