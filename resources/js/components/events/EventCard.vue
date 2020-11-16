<template>
  <li class="mb-6 w-full">
    <div class="max-w-6xl rounded overflow-hidden shadow-lg w-full">
      <simple-map :location="location" class="w-full"></simple-map>
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ name }}</div>
        <p class="text-gray-700 text-base">
          {{ shortDescription }}
          <inertia-link
            :href="route('events.show', id)"
            class="text-blue-600 underline cursor-pointer"
            >More details</inertia-link
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
  </li>
</template>

<script lang="ts">
import { formatDateTime } from '../../utils/date'
import SimpleMap from '../maps/SimpleMap.vue'
import { defineComponent, computed } from 'vue'

export default defineComponent({
  components: {
    SimpleMap,
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
    description: {
      type: String,
      required: true,
    },
    datetime: {
      type: String,
      required: true,
    },
    location: {
      type: String,
      required: true,
    },
    organizer_id: {
      type: Number,
      required: true,
    },
    created_at: {
      type: String,
      required: true,
    },
    updated_at: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    const formattedDateTime = computed(() => formatDateTime(props.datetime))

    const shortDescription = computed(() => {
      if (props.description.length <= 50) {
        return props.description
      }
      const first30 = props.description.substring(0, 50).split(' ')
      first30.pop()
      return first30.join(' ') + '.........'
    })

    return {
      formattedDateTime,
      shortDescription,
    }
  },
})
</script>
