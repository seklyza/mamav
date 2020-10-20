<template>
  <main-layout title="Create Event">
    <div class="mx-64">
      <form @submit.prevent="onSubmit">
        <base-form-input
          name="name"
          label="Event Name"
          v-model.trim="form.name"
        ></base-form-input>
        <base-form-textarea
          name="description"
          label="Event Description"
          rows="10"
          v-model.trim="form.description"
        ></base-form-textarea>
        <base-form-input
          type="date"
          name="datetime"
          label="Event Date"
          v-model.trim="form.date"
          max="2028-12-31"
        ></base-form-input>
        <base-form-input
          type="time"
          name="time"
          label="Event Time"
          v-model.trim="form.time"
          :show-errors="false"
        ></base-form-input>
        <base-form-input
          type="location"
          name="location"
          label="Event Location"
          :model-value="form.location"
          @input="onLocationUpdate"
        ></base-form-input>
        <simple-map
          v-if="form.location"
          class="mt-4"
          :location="form.location"
        ></simple-map>
        <base-button class="p-3 rounded-md">Create Event</base-button>
      </form>
    </div>
  </main-layout>
</template>

<script lang="ts" setup>
import _debounce from 'lodash/debounce'

import SimpleMap from '../../components/maps/SimpleMap.vue'
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'

export const form = reactive({
  name: '',
  description: '',
  date: '',
  time: '',
  location: '',
})

export function onSubmit() {
  const datetime = (() => {
    try {
      const datetime = new Date(form.date)
      const [hours, minutes] = form.time.split(':')
      datetime.setHours(hours as any)
      datetime.setMinutes(minutes as any)
      return datetime
    } catch (e) {
      return ''
    }
  })()

  const formData = {
    name: form.name,
    description: form.description,
    datetime,
    location: form.location,
  }

  Inertia.post(route('events.store'), formData)
}

export const onLocationUpdate = _debounce(e => {
  form.location = e.target.value
}, 1000)

export default {
  components: {
    SimpleMap,
  },
}
</script>
