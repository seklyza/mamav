<template>
  <button
    class="text-white p-0 w-16 h-16 bg-primary rounded-full hover:bg-blue-800 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none fixed bottom-16px right-16px"
    @click="$emit('click')"
  >
    <plus-icon class="w-6 h-6 inline-block"></plus-icon>
  </button>
</template>

<script>
export default {
  emits: ['click'],
}
</script>
