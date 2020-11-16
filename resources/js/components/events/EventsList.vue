<template>
  <ul>
    <event-card
      v-for="event in events"
      :key="event.id"
      v-bind="event"
    ></event-card>
  </ul>
</template>

<script lang="ts">
import { Event } from '@/types'
import { defineComponent, PropType } from 'vue'

import EventCard from './EventCard.vue'

export default defineComponent({
  components: {
    EventCard,
  },
  props: {
    events: {
      type: Array as PropType<Event[]>,
      required: true,
    },
  },
})
</script>
