<template>
  <auth-layout>
    <p class="text-center text-3xl">Login to MaMaV</p>
    <base-alert
      v-if="$page.props.flash.message"
      color="red"
      message1="Could not login:"
      :message2="$page.props.flash.message"
    ></base-alert>
    <form class="flex flex-col pb-3 md:pb-8" @submit.prevent="onSubmit">
      <base-form-input
        name="username"
        label="Username"
        v-model.trim="username"
      ></base-form-input>

      <base-form-input
        type="password"
        name="password"
        label="Password"
        v-model.trim="password"
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
import { reactive, toRefs, watchEffect } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  setup() {
    const state = reactive({
      username: '',
      password: '',
    })

    function onSubmit() {
      const formData = { ...state }

      Inertia.post(route('login.store'), formData)
    }

    return {
      ...toRefs(state),

      onSubmit,
    }
  },
}
</script>
