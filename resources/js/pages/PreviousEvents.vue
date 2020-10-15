<template>
  <main-layout title="Previous Events">
    <h1>Previous Events</h1>
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
