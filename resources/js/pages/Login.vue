<template>
  <auth-layout>
    <p class="text-center text-3xl">Login to MaMaV</p>
    <form class="flex flex-col pt-3 md:pt-8" @submit.prevent="onSubmit">
      <div class="flex flex-col pt-4">
        <label for="username" class="text-lg">Username</label>
        <input
          type="text"
          id="username"
          placeholder="Username"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
          :class="{
            'border-red-700': form.username.error || $page.errors.username,
          }"
          autocomplete="off"
          v-model.trim="form.username.val"
          @blur="clearValidity('username')"
        />
        <p
          v-if="form.username.error || $page.errors.username"
          class="text-red-700"
        >
          {{ form.username.error || $page.errors.username }}
        </p>
      </div>

      <div class="flex flex-col pt-4">
        <label for="password" class="text-lg">Password</label>
        <input
          type="password"
          id="password"
          placeholder="Password"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
          :class="{
            'border-red-700': form.password.error || $page.errors.password,
          }"
          v-model.trim="form.password.val"
          @blur="clearValidity('password')"
        />
        <p
          v-if="form.password.error || $page.errors.password"
          class="text-red-700"
        >
          {{ form.password.error || $page.errors.password }}
        </p>
      </div>

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

import { useForm } from '../hooks/useForm'

export default defineComponent({
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
