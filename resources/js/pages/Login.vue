<template>
  <auth-layout>
    <p class="text-center text-3xl">Login to MaMaV</p>
    <form class="flex flex-col pt-3 md:pt-8" @submit.prevent="onSubmit">
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

      <base-button>Log In</base-button>
    </form>
    <div class="text-center pt-12 pb-12">
      <p>
        Don't have an account?
        <inertia-link
          :href="$route('pages.register')"
          class="underline font-semibold"
        >
          Register here.
        </inertia-link>
      </p>
    </div>
  </auth-layout>
</template>

<script>
import { defineComponent, reactive, toRefs } from '@vue/composition-api'

import FormInput from '../components/auth/FormInput.vue'
import { useForm } from '../hooks/useForm'

export default defineComponent({
  components: {
    FormInput,
  },
  setup(_, { root: { $inertia } }) {
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

      $inertia.post(route('pages.login'), formData)
    }

    return {
      form,

      clearValidity,
      onSubmit,
    }
  },
})
</script>
