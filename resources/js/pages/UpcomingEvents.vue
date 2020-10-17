<template>
  <main-layout title="Upcoming Events">
    <events-list :events="events"></events-list>
    <base-fab @click="visitCreateEvent"></base-fab>
  </main-layout>
</template>

<script lang="ts" setup>
import EventsList from '../components/events/EventsList.vue'
import { useCreateEvent } from '../hooks/methods/useCreateEvent'

export const { visitCreateEvent } = useCreateEvent()

export default {
  components: {
    EventsList,
  },
  props: ['events'],
}
</script>
