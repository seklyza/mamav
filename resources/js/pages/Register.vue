<template>
  <auth-layout>
    <p class="text-center text-3xl">Register to MaMaV</p>
    <error-alert
      v-if="$page.flash.message"
      :error="$page.flash.message"
    ></error-alert>
    <form class="flex flex-col pt-3 md:pt-8" @submit.prevent="onSubmit">
      <form-input
        name="name"
        label="Name"
        v-model.trim="form.name.val"
        :error="form.name.error"
        @clear-validity="clearValidity"
      ></form-input>

      <form-input
        name="email"
        label="Email"
        v-model.trim="form.email.val"
        :error="form.email.error"
        @clear-validity="clearValidity"
      ></form-input>

      <form-input
        name="username"
        label="Username"
        v-model.trim="form.username.val"
        :error="form.username.error"
        @clear-validity="clearValidity"
      ></form-input>

      <form-input
        type="password"
        name="password"
        label="Password"
        v-model.trim="form.password.val"
        :error="form.password.error"
        @clear-validity="clearValidity"
      ></form-input>

      <form-input
        type="password"
        name="password_confirmation"
        label="Confirm Password"
        v-model.trim="form.password_confirmation.val"
        :error="form.password_confirmation.error"
        @clear-validity="clearValidity"
      ></form-input>

      <base-button>Register</base-button>
    </form>
    <div class="text-center pt-12 pb-12">
      <p>
        Already have an account?
        <inertia-link
          :href="$route('pages.login')"
          class="underline font-semibold"
        >
          Log in here.
        </inertia-link>
      </p>
    </div>
  </auth-layout>
</template>

<script>
import { defineComponent } from '@vue/composition-api'
import { useForm } from '../hooks/useForm'

import ErrorAlert from '../components/auth/ErrorAlert.vue'
import FormInput from '../components/auth/FormInput.vue'

export default defineComponent({
  components: {
    ErrorAlert,
    FormInput,
  },
  setup(_, { root: { $inertia } }) {
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

      $inertia.post(route('pages.register'), formData)
    }

    return {
      form,

      clearValidity,
      onSubmit,
    }
  },
})
</script>
