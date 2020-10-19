<template>
  <component :is="rootEl" class="mb-6 w-full">
    <div class="max-w-6xl rounded overflow-hidden shadow-lg w-full">
      <!-- <img class="w-full" :src="image_url" alt="Sunset in the mountains" /> -->
      <simple-map :location="location" class="w-full"></simple-map>
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ name }}</div>
        <p class="text-gray-700 text-base">
          {{ description }}
        </p>
        <p class="mt-4" v-if="rootEl === 'li'">
          <inertia-link
            :href="route('events.show', id)"
            class="text-blue-600 underline cursor-pointer"
            >More details...</inertia-link
          >
        </p>
      </div>
      <div class="px-6 pt-4 pb-2">
        <span
          class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"
          >{{ formattedDateTime }}</span
        >
        <span
          class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"
          >{{ location }}</span
        >
      </div>
    </div>
  </component>
</template>

<script>
import dayjs from 'dayjs'

import SimpleMap from '../maps/SimpleMap'

export default {
  components: {
    SimpleMap,
  },
  props: {
    id: Number,
    name: String,
    description: String,
    datetime: String,
    location: String,
    image_url: String,
    organizer_id: Number,
    created_at: String,
    updated_at: String,
    pivot: Object,
    rootEl: {
      type: String,
      default: 'li',
    },
  },
  computed: {
    formattedDateTime() {
      return dayjs(this.datetime).format('dddd, MMMM D, YYYY, hh:mm A')
    },
  },
}
</script>
