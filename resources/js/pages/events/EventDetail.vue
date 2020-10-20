<template>
  <main-layout>
    <div class="mb-6 w-full">
      <div class="max-w-6xl rounded overflow-hidden shadow-lg w-full">
        <simple-map :location="event.location" class="w-full"></simple-map>
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">{{ event.name }}</div>
          <p class="text-gray-700 text-base">
            {{ event.description }}
          </p>
        </div>
        <a
          href="javascript:void(0)"
          class="mx-6 text-blue-500 cursor-pointer"
          v-if="join_secret"
          @click="copyLinkToClipboard"
        >
          Copy Invite Link to Clipboard
        </a>
        <div class="px-6 pt-4 pb-2">
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
      </div>
    </div>
  </main-layout>
</template>

<script lang="ts" setup="props">
import { computed, PropType } from 'vue'

import SimpleMap from '../../components/maps/SimpleMap.vue'
import { Event } from '../../types'
import { formatDateTime } from '../../utils/date'

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

  const input = document.createElement('input')
  input.style.position = 'absolute'
  input.style.left = '-9999px'
  document.body.appendChild(input)
  input.value = inviteLink
  input.select()
  document.execCommand('copy')
  document.body.removeChild(input)
}

export default {
  components: {
    SimpleMap,
  },
}
</script>
