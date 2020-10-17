<template>
  <main-layout title="Create Event">
    <form @submit.prevent="onSubmit">
      <base-form-input
        name="name"
        label="Event Name"
        v-model.trim="name"
      ></base-form-input>
    </form>
  </main-layout>
</template>

<script>
export default {
  data() {
    return {
      name: '',
    }
  },
  methods: {
    onSubmit() {},
  },
}
</script>
