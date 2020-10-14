<template>
  <div ref="map" class="map" v-show="showMap"></div>
</template>

<script>
export default {
  props: ['location'],
  data() {
    return {
      showMap: false,
    }
  },
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

      this.showMap = true
    })
  },
}
</script>

<style scoped>
.map {
  height: 400px;
}
</style>
