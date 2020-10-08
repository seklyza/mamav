<template>
  <auth-layout>
    <p class="text-center text-3xl">Login to MaMaV</p>
    <form class="flex flex-col pt-3 md:pt-8" onsubmit="event.preventDefault();">
      <div class="flex flex-col pt-4">
        <label for="email" class="text-lg">Email</label>
        <input
          type="email"
          id="email"
          placeholder="your@email.com"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
          autocomplete="off"
        />
      </div>

      <div class="flex flex-col pt-4">
        <label for="password" class="text-lg">Password</label>
        <input
          type="password"
          id="password"
          placeholder="Password"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
        />
      </div>

      <base-button>Log In</base-button>
    </form>
    <div class="text-center pt-12 pb-12">
      <p>
        Don't have an account?
        <inertia-link :href="$route('pages.register')" class="underline font-semibold">
          Register here.
        </inertia-link>
      </p>
    </div>
  </auth-layout>
</template>
