<template>
  <auth-layout>
    <p class="text-center text-3xl">Register to MaMaV</p>
    <base-alert
      v-if="$page.props.flash.message"
      color="red"
      message1="Could not login:"
      :message2="$page.props.flash.message"
    ></base-alert>
    <base-alert
      v-if="$page.props.success"
      color="green"
      message1="Hooray!"
      :message2="$page.props.success"
    ></base-alert>
    <form class="flex flex-col pt-3 md:pt-8" @submit.prevent="onSubmit">
      <base-form-input
        name="name"
        label="Name"
        v-model.trim="form.name"
      ></base-form-input>

      <base-form-input
        name="email"
        label="Email"
        v-model.trim="form.email"
      ></base-form-input>

      <base-form-input
        name="username"
        label="Username"
        v-model.trim="form.username"
      ></base-form-input>

      <base-form-input
        type="password"
        name="password"
        label="Password"
        v-model.trim="form.password"
      ></base-form-input>

      <base-form-input
        type="password"
        name="password_confirmation"
        label="Confirm Password"
        v-model.trim="form.confirmPassword"
      ></base-form-input>

      <base-button>Register</base-button>
    </form>
    <div class="text-center pt-12 pb-12">
      <p>
        Already have an account?
        <inertia-link :href="route('login')" class="underline font-semibold">
          Log in here.
        </inertia-link>
      </p>
    </div>
  </auth-layout>
</template>

<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'

export const form = reactive({
  name: '',
  email: '',
  username: '',
  password: '',
  confirmPassword: '',
})

export function onSubmit() {
  if (route().current('register')) {
    const formData = {
      name: form.name,
      email: form.email,
      username: form.username,
      password: form.password,
      password_confirmation: form.confirmPassword,
    }

    Inertia.post(route('register.store'), formData)
  }
}
</script>
