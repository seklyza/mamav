<template>
  <ul>
    <event-card
      v-for="event in events"
      :key="event.id"
      v-bind="event"
    ></event-card>
  </ul>
</template>

<script>
import EventCard from './EventCard'

export default {
  components: {
    EventCard,
  },
  props: ['events'],
}
</script>
