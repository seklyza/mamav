<template>
  <main-layout>
    <div class="w-full">
      <h1 class="font-bold text-3xl mb-2">{{ event.name }}</h1>
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
    <simple-map :location="event.location" class="w-1/3"></simple-map>
    <div class="my-6 w-1/4">
      <h2 class="text-2xl font-bold mb-4">Event Participants:</h2>
      <ul>
        <li
          v-for="participant in event.participants"
          :key="participant.id"
          class="shadow-md mb-4 p-4"
        >
          {{ participant.name }} (@{{ participant.username }})
          <span
            v-if="auth.user.id === participant.id"
            class="text-primary italic font-bold"
          >
            you
          </span>
        </li>
      </ul>
    </div>
    <div class="mb-64">
      <button
        class="bg-red-600 rounded text-white font-bold text-lg hover:bg-red-800 p-3 mt-6"
        @click="leaveEvent"
      >
        {{ auth.user.id === event.organizer_id ? 'Leave and Delete' : 'Leave' }}
        Event
      </button>
    </div>
  </main-layout>
</template>

<script lang="ts" setup="props">
import { computed } from 'vue'

import SimpleMap from '../../components/maps/SimpleMap.vue'
import { Event } from '../../types'
import { formatDateTime } from '../../utils/date'
import { copyToClipboard } from '../../utils/clipboard'
import { Inertia } from '@inertiajs/inertia'

declare const props: {
  event: Event
  join_secret?: string
  auth: {
    user: {
      id: string
    }
  }
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

export function leaveEvent() {
  if (confirm('Are you sure you want to leave this event?')) {
    Inertia.delete(route('events.delete', props.event.id))
  }
}

export default {
  components: {
    SimpleMap,
  },
}
</script>
