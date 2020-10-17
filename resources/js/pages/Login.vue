<template>
  <auth-layout>
    <p class="text-center text-3xl">Login to MaMaV</p>
    <base-alert
      v-if="$page.flash.message"
      color="red"
      message1="Could not login:"
      :message2="$page.flash.message"
    ></base-alert>
    <form class="flex flex-col pb-3 md:pb-8" @submit.prevent="onSubmit">
      <base-form-input
        name="username"
        label="Username"
        v-model.trim="form.username.val"
        :error="form.username.error"
        @clear-validity="clearValidity"
      ></base-form-input>

      <base-form-input
        type="password"
        name="password"
        label="Password"
        v-model.trim="form.password.val"
        :error="form.password.error"
        @clear-validity="clearValidity"
      ></base-form-input>

      <base-button>Log In</base-button>
    </form>
    <div class="text-center pt-12 pb-12">
      <p>
        Don't have an account?
        <inertia-link :href="route('register')" class="underline font-semibold">
          Register here.
        </inertia-link>
      </p>
    </div>
  </auth-layout>
</template>

<script>
import { defineComponent, reactive, toRefs } from '@vue/composition-api'
import { Inertia } from '@inertiajs/inertia'

import { useForm } from '../hooks/useForm'

export default defineComponent({
  setup() {
    const { form, clearValidity, handleSubmit } = useForm(
      [
        'username',
        '',
        val => (val === '' ? 'The username field is required' : false),
      ],
      [
        'password',
        '',
        val => (val === '' ? 'The password field is required' : false),
      ],
    )

    function onSubmit() {
      const formData = handleSubmit()
      if (!formData) return

      Inertia.post(route('login.store'), formData)
    }

    return {
      form,

      clearValidity,
      onSubmit,
    }
  },
})
</script>
