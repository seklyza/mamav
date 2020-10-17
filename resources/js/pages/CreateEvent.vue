<template>
  <main-layout title="Create Event">
    <form @submit.prevent="onSubmit">
      <base-form-input
        name="name"
        label="Event Name"
        v-model.trim="form.name.val"
        :error="form.name.error"
        @clear-validity="clearValidity"
      ></base-form-input>
    </form>
  </main-layout>
</template>

<script>
import { useForm } from '../hooks/useForm'
export default {
  setup() {
    const { form, clearValidity, handleSubmit } = useForm(
      ['name', '', val => (val === '' ? 'This field is required' : false)],
      ['description', ''],
      ['datetime', Date.now()],
      [],
    )

    function onSubmit() {
      const formData = handleSubmit()
      if (!formData) return

      console.log(formData)
    }

    return {
      form,
      clearValidity,
      onSubmit,
    }
  },
}
</script>
