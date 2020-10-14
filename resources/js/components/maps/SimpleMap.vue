<template>
  <div ref="map" class="map"></div>
</template>

<script>
export default {
  props: ['location'],
  async mounted() {
    const geocoder = new google.maps.Geocoder()
    geocoder.geocode({ address: this.location }, results => {
      if (!results.length) return

      const loc = {
        lat: results[0].geometry.location.lat(),
        lng: results[0].geometry.location.lng(),
      }
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
