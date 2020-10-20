<template>
  <main-layout title="Create Event">
    <div class="mx-64">
      <form @submit.prevent="onSubmit">
        <base-form-input
          name="name"
          label="Event Name"
          v-model.trim="name"
        ></base-form-input>
        <base-form-textarea
          name="description"
          label="Event Description"
          rows="10"
          v-model.trim="description"
        ></base-form-textarea>
        <base-form-input
          type="date"
          name="datetime"
          label="Event Date"
          v-model.trim="date"
          max="2028-12-31"
        ></base-form-input>
        <base-form-input
          type="time"
          name="time"
          label="Event Time"
          v-model.trim="time"
          :show-errors="false"
        ></base-form-input>
        <base-form-input
          type="location"
          name="location"
          label="Event Location"
          :model-value="location"
          @input="onLocationUpdate"
        ></base-form-input>
        <simple-map
          v-if="location"
          class="mt-4"
          :location="location"
        ></simple-map>
        <base-button class="p-3 rounded-md">Create Event</base-button>
      </form>
    </div>
  </main-layout>
</template>

<script>
import _debounce from 'lodash/debounce'

import SimpleMap from '../../components/maps/SimpleMap.vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  components: {
    SimpleMap,
  },
  data() {
    return {
      name: '',
      description: '',
      date: '',
      time: '',
      location: '',
    }
  },
  methods: {
    onSubmit() {
      const datetime = (() => {
        try {
          const datetime = new Date(this.date)
          const [hours, minutes] = this.time.split(':')
          datetime.setHours(hours)
          datetime.setMinutes(minutes)
          return datetime
        } catch (e) {
          return ''
        }
      })()

      const formData = {
        name: this.name,
        description: this.description,
        datetime,
        location: this.location,
      }

      Inertia.post(route('events.store'), formData)
    },
    onLocationUpdate: _debounce(function(e) {
      this.location = e.target.value
    }, 1000),
  },
}
</script>
