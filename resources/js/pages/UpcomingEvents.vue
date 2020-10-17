<template>
  <main-layout title="Upcoming Events">
    <events-list :events="events"></events-list>
    <base-fab @click="visitCreateEvent"></base-fab>
  </main-layout>
</template>

<script>
import EventsList from '../components/events/EventsList'
import { useCreateEvent } from '../hooks/methods/useCreateEvent'

export default {
  components: {
    EventsList,
  },
  props: ['events'],
  setup() {
    const { visitCreateEvent } = useCreateEvent()

    return {
      visitCreateEvent,
    }
  },
}
</script>
