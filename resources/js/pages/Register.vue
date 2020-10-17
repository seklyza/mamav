<template>
  <auth-layout>
    <p class="text-center text-3xl">Register to MaMaV</p>
    <base-alert
      v-if="$page.flash.message"
      color="red"
      message1="Could not login:"
      :message2="$page.flash.message"
    ></base-alert>
    <base-alert
      v-if="$page.success"
      color="green"
      message1="Hooray!"
      :message2="$page.success"
    ></base-alert>
    <form class="flex flex-col pt-3 md:pt-8" @submit.prevent="onSubmit">
      <base-form-input
        name="name"
        label="Name"
        v-model.trim="form.name.val"
        :error="form.name.error"
        @clear-validity="clearValidity"
      ></base-form-input>

      <base-form-input
        name="email"
        label="Email"
        v-model.trim="form.email.val"
        :error="form.email.error"
        @clear-validity="clearValidity"
      ></base-form-input>

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

      <base-form-input
        type="password"
        name="password_confirmation"
        label="Confirm Password"
        v-model.trim="form.password_confirmation.val"
        :error="form.password_confirmation.error"
        @clear-validity="clearValidity"
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

<script>
import { defineComponent } from '@vue/composition-api'
import { useForm } from '../hooks/useForm'
import { Inertia } from '@inertiajs/inertia'

export default defineComponent({
  setup() {
    const { form, clearValidity, handleSubmit } = useForm(
      ['name', '', val => (val === '' ? 'The name field is required' : false)],
      [
        'email',
        '',
        val => (val === '' ? 'The e-mail field is required' : false),
      ],
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
      [
        'password_confirmation',
        '',
        val => (val === '' ? 'The confirm password field is required' : false),
      ],
    )

    function onSubmit() {
      const formData = handleSubmit()
      if (!formData) return

      if (route().current('register')) {
        Inertia.post(route('register.store'), formData)
      }
    }

    return {
      form,

      clearValidity,
      onSubmit,
    }
  },
})
</script>
