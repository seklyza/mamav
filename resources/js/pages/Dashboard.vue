<template>
  <main-layout>
    <h1>Dashboard</h1>
    <div v-for="event in events" :key="event.id">
      <simple-map :location="event.location"></simple-map>
    </div>
  </main-layout>
</template>

<script>
import SimpleMap from '../components/maps/SimpleMap'

export default {
  components: {
    SimpleMap,
  },
  props: ['events'],
}
</script>
