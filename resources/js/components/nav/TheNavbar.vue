<template>
  <nav class="flex items-center justify-between flex-wrap bg-primary p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      <img
        src="/svg/default-monochrome-white.svg"
        width="54"
        height="54"
        class="mr-4"
      />
      <span class="font-semibold text-xl tracking-tight">MaMaV</span>
    </div>
    <div class="block lg:hidden">
      <button
        class="flex items-center px-3 py-2 border rounded text-white hover:text-white hover:border-white"
        @click="menuExpanded = !menuExpanded"
      >
        <menu-icon class="text-white w-4"></menu-icon>
      </button>
    </div>
    <div
      class="w-full flex-grow lg:flex lg:items-center lg:w-auto"
      :class="menuExpanded ? 'block' : 'hidden'"
    >
      <div class="text-sm lg:flex-grow">
        <nav-link to="upcoming-events">
          Upcoming Events
        </nav-link>
        <nav-link to="my-events">
          My Events
        </nav-link>
        <nav-link to="previous-events">
          Previous Events
        </nav-link>
        <nav-link to="settings">
          Settings
        </nav-link>
      </div>
      <div>
        <span class="text-white mr-2">Hello, {{ $page.auth.user.name }}</span>
        <button
          @click="logout"
          class="inline-block text-sm px-4 py-2 leading-none border rounded text-gray-300 border-white hover:border-transparent hover:text-primary hover:bg-white mt-4 lg:mt-0"
        >
          Sign Out
        </button>
      </div>
    </div>
  </nav>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'

import NavLink from './NavLink'

export default {
  components: {
    NavLink,
  },
  data() {
    return {
      menuExpanded: false,
    }
  },
  methods: {
    logout() {
      Inertia.post(route('logout'))
    },
  },
}
</script>
