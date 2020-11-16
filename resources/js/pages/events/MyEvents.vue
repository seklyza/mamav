<template>
  <main-layout title="My Events">
    <p v-if="events.length === 0" class="flex justify-center">
      You haven't created any events. Click the button on the bottom right to
      add one!
    </p>
    <events-list v-else :events="events"></events-list>
    <base-fab @click="visitCreateEvent"></base-fab>
  </main-layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import EventsList from '@/components/events/EventsList.vue'

export default defineComponent({
  props: ['events'],
  components: {
    EventsList,
  },
  methods: {
    visitCreateEvent() {
      Inertia.visit(route('events.create'))
    },
  },
})
</script>
