<template>
  <main-layout>
    <div class="w-full">
      <simple-map :location="event.location" class="w-full"></simple-map>
      <h1 class="font-bold text-xl mb-2">{{ event.name }}</h1>
      <div>
        <span
          class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"
        >
          {{ formattedDateTime }}
        </span>
        <span
          class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"
        >
          {{ event.location }}
        </span>
      </div>
      <div class="my-4">
        <p class="text-gray-700 text-base">
          {{ event.description }}
        </p>
      </div>
      <a
        href="javascript:void(0)"
        class="text-blue-500 cursor-pointer"
        v-if="join_secret"
        @click="copyLinkToClipboard"
      >
        Copy Invite Link to Clipboard
      </a>
    </div>
  </main-layout>
</template>

<script lang="ts" setup="props">
import { computed } from 'vue'

import SimpleMap from '../../components/maps/SimpleMap.vue'
import { Event } from '../../types'
import { formatDateTime } from '../../utils/date'
import { copyToClipboard } from '../../utils/clipboard'

declare const props: {
  event: Event
  join_secret?: string
}

export const formattedDateTime = computed(() =>
  formatDateTime(props.event.datetime),
)

export function copyLinkToClipboard() {
  const inviteLink = route('events.show', {
    id: props.event.id,
    link: props.join_secret,
  }).toString()

  copyToClipboard(inviteLink)
}

export default {
  components: {
    SimpleMap,
  },
}
</script>
