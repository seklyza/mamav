<template>
  <div ref="map" class="map"></div>
</template>

<script>
import GoogleMapsAPILoader from 'google-maps-api-loader'

export default {
  props: ['lat', 'long'],
  async mounted() {
    const loc = { lat: this.lat, lng: this.long }
    const map = new google.maps.Map(this.$refs.map, {
      center: loc,
      zoom: 16,
      disableDefaultUI: true,
      clickableIcons: false,
    })

    new google.maps.Marker({
      position: loc,
      map,
    })
  },
}
</script>

<style scoped>
.map {
  height: 600px;
  width: 600px;
}
</style>
