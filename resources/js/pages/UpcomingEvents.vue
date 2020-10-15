<template>
  <main-layout title="Upcoming Events">
    <events-list :events="events"></events-list>
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
