<template>
  <main-layout title="Upcoming Events">
    <events-list :events="events"></events-list>
    <base-fab @click="visitCreateEvent"></base-fab>
  </main-layout>
</template>

<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia'
import EventsList from '../../components/events/EventsList.vue'

export function visitCreateEvent() {
  Inertia.visit(route('events.create'))
}

export default {
  components: {
    EventsList,
  },
  props: ['events'],
}
</script>
