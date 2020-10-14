<template>
  <main-layout>
    <h1>Dashboard</h1>
    <simple-map :lat="+events[0].lat" :long="+events[0].long"></simple-map>
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
