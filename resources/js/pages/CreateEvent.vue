<template>
  <main-layout title="Create Event">
    <div class="mx-64">
      <form @submit.prevent="onSubmit">
        <base-form-input
          name="name"
          label="Event Name"
          v-model.trim="name"
        ></base-form-input>
        <base-form-input
          type="date"
          name="date"
          label="Event Date"
          v-model.trim="date"
        ></base-form-input>
        <base-form-input
          type="time"
          name="time"
          label="Event Time"
          v-model.trim="time"
        ></base-form-input>
        <base-form-input
          type="location"
          name="location"
          label="Event Location"
          @input="onLocationUpdate"
        ></base-form-input>
        <simple-map
          v-if="location"
          class="mt-4"
          :location="location"
        ></simple-map>
      </form>
    </div>
  </main-layout>
</template>

<script>
import _debounce from 'lodash/debounce'

import SimpleMap from '../components/maps/SimpleMap.vue'

export default {
  components: {
    SimpleMap,
  },
  data() {
    return {
      name: '',
      date: '',
      time: '',
      location: '',
    }
  },
  methods: {
    onSubmit() {},
    onLocationUpdate: _debounce(function(e) {
      this.location = e.target.value
    }, 1000),
  },
}
</script>
