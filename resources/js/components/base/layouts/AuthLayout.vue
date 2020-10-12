<template>
  <div class="bg-white font-family-karla h-screen">
    <div class="w-full flex flex-wrap">
      <div class="w-full md:w-1/2 flex flex-col">
        <div
          class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-12"
        >
          <inertia-link :href="route('index')" class="p-4">
            <img src="/svg/monochrome-logo.svg" width="90" />
          </inertia-link>
        </div>

        <div
          class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32"
        >
          <slot></slot>
        </div>
      </div>

      <div class="w-1/2 shadow-2xl">
        <img
          class="object-cover w-full h-screen hidden md:block"
          src="/images/cover.png"
        />
      </div>
    </div>
  </div>
</template>
