<template>
  <inertia-link
    :href="route(to)"
    class="block mt-4 lg:inline-block lg:mt-0 hover:text-white mr-4"
    :class="route().current(to) ? 'text-white' : 'text-gray-400'"
  >
    <slot></slot>
  </inertia-link>
</template>

<script>
export default {
  props: ['to'],
}
</script>
