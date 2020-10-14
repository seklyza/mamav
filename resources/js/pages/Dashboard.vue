<template>
  <main-layout>
    <ul>
      <event-card
        v-for="event in events"
        :key="event.id"
        v-bind="event"
      ></event-card>
    </ul>
  </main-layout>
</template>

<script>
import EventCard from '../components/events/EventCard'

export default {
  components: {
    EventCard,
  },
  props: ['events'],
}
</script>
