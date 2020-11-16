<template>
  <main-layout title="Upcoming Events">
    <events-list :events="events"></events-list>
    <base-fab @click="visitCreateEvent"></base-fab>
  </main-layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import EventsList from '@/components/events/EventsList.vue'

export default defineComponent({
  components: {
    EventsList,
  },
  props: ['events'],
  methods: {
    visitCreateEvent() {
      Inertia.visit(route('events.create'))
    },
  },
})
</script>
