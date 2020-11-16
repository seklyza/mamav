<template>
  <main-layout :title="event.name">
    <div class="w-full">
      <base-title>{{ event.name }}</base-title>
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
        class="text-blue-500 cursor-pointer font-bold"
        v-if="join_secret"
        @click="copyLinkToClipboard"
      >
        Copy Invite Link to Clipboard
      </a>
      <a
        href="javascript:void(0)"
        class="ml-3 w-4 inline cursor-pointer text-red-500 font-bold"
        v-if="join_secret"
        @click="generateANewLink"
      >
        Generate a New Link and Copy to Clipboard
      </a>
    </div>
    <simple-map :location="event.location" class="w-1/3"></simple-map>
    <div class="my-6 w-1/4">
      <h2 class="text-2xl font-bold mb-4">Event Participants:</h2>
      <ul>
        <li
          v-for="participant in event.participants || []"
          :key="participant.id"
          class="shadow-md mb-4 p-4"
        >
          {{ participant.name }} ({{ participant.username }})
          <span
            v-if="auth.user.id === participant.id"
            class="text-primary italic font-bold"
          >
            (you)
          </span>
          <span
            v-if="event.organizer_id === participant.id"
            class="text-red-500 italic font-bold"
          >
            (organizer)
          </span>
          <div
            v-if="isOwnerOfEvent && auth.user.id !== participant.id"
            class="float-right"
          >
            <chevron-double-up-icon
              class="w-4 inline cursor-pointer mr-1 text-green-700"
              @click="makeEventOrganizer(participant)"
            ></chevron-double-up-icon>
            <x-icon
              class="w-4 inline cursor-pointer text-red-500"
              @click="removeParticipant(participant)"
            ></x-icon>
          </div>
        </li>
      </ul>
    </div>
    <div class="mb-64">
      <button
        class="bg-red-600 rounded text-white font-bold text-lg hover:bg-red-800 p-3 mt-6"
        @click="leaveEvent"
      >
        {{ isOwnerOfEvent ? 'Leave and Delete' : 'Leave' }}
        Event
      </button>
      <base-button
        btnType="inertia-link"
        class="p-3 ml-3 cursor-pointer"
        v-if="isOwnerOfEvent"
        :href="route('events.items', event.id)"
      >
        Manage Items
      </base-button>
    </div>
  </main-layout>
</template>

<script lang="ts">
import { defineComponent, computed, PropType } from 'vue'

import SimpleMap from '../../components/maps/SimpleMap.vue'
import { Event, User } from '../../types'
import { formatDateTime } from '../../utils/date'
import { copyToClipboard } from '../../utils/clipboard'
import { Inertia } from '@inertiajs/inertia'

export default defineComponent({
  components: {
    SimpleMap,
  },
  props: {
    event: {
      type: Object as PropType<Event>,
      required: true,
    },
    join_secret: String,
    auth: {
      type: Object as PropType<{ user: User }>,
      required: true,
    },
  },
  setup(props) {
    const formattedDateTime = computed(() =>
      formatDateTime(props.event.datetime),
    )

    const isOwnerOfEvent = computed(
      () => props.auth.user.id === props.event.organizer_id,
    )

    function copyLinkToClipboard() {
      const inviteLink = route('events.show', {
        event: props.event.id,
        link: props.join_secret,
      }).toString()

      copyToClipboard(inviteLink)
    }

    function leaveEvent() {
      if (confirm('Are you sure you want to leave this event?')) {
        Inertia.delete(route('events.delete', props.event.id))
      }
    }

    function makeEventOrganizer(
      participant: NonNullable<typeof props['event']['participants']>[number],
    ) {
      if (
        confirm(
          `Are you sure you want to make ${participant.name} the organizer of this event?`,
        )
      ) {
        Inertia.post(
          route('events.participants.make-organizer', [
            props.event.id,
            participant.id,
          ]),
          {},
          { preserveScroll: true },
        )
      }
    }

    function removeParticipant(
      participant: NonNullable<typeof props['event']['participants']>[number],
    ) {
      if (
        confirm(
          `Are you sure you want to remove ${participant.name} from the event?`,
        )
      ) {
        Inertia.delete(
          route('events.participants.delete', [props.event.id, participant.id]),
          { preserveScroll: true },
        )
      }
    }

    async function generateANewLink() {
      if (
        confirm(
          `Are you sure you want to revoke the current link and generate a new one?
The new link will be copied to your clipboard.`,
        )
      ) {
        await Inertia.post(
          route('events.generate-link', props.event.id),
          {},
          {
            preserveScroll: true,
            onSuccess: copyLinkToClipboard,
          },
        )
      }
    }

    return {
      formattedDateTime,
      isOwnerOfEvent,

      copyLinkToClipboard,
      leaveEvent,
      makeEventOrganizer,
      removeParticipant,
      generateANewLink,
    }
  },
})
</script>
