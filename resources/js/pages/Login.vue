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

export default defineComponent({
  setup(_, { root: { $inertia } }) {
    const state = reactive({
      form: {
        isValid: true,
        username: {
          val: '',
          error: null,
        },
        password: {
          val: '',
          error: null,
        },
      },
    })

    function clearValidity(input) {
      state.form[input].error = null
    }

    function validateForm() {
      state.form.isValid = true
      if (state.form.username.val === '') {
        state.form.isValid = false
        state.form.username.error = 'The username field is required'
      }
      if (state.form.password.val === '') {
        state.form.isValid = false
        state.form.password.error = 'The password field is required'
      }
    }

    function onSubmit() {
      validateForm()

      if (!state.form.isValid) return

      const formData = {
        username: state.form.username.val,
        password: state.form.password.val,
      }

      $inertia.post(route('pages.login'), formData)
    }

    return {
      ...toRefs(state),

      clearValidity,
      validateForm,
      onSubmit,
    }
  },
})
</script>
