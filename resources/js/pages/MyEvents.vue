<template>
  <main-layout title="My Events">
    <p v-if="events.length === 0" class="flex justify-center">
      You haven't created any events. Click the button on the bottom right to
      add one!
    </p>
    <events-list v-else :events="events"></events-list>
    <base-fab></base-fab>
  </main-layout>
</template>

<script>
import EventsList from '../components/events/EventsList'

export default {
  components: {
    EventsList,
  },
  props: ['events'],
}
</script>
