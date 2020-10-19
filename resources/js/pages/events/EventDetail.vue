<template>
  <main-layout>
    <event-card root-el="div" v-bind="event"></event-card>
  </main-layout>
</template>

<script>
import EventCard from '../../components/events/EventCard.vue'

export default {
  components: {
    EventCard,
  },
  props: ['event'],
}
</script>
