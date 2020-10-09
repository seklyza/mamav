<template>
  <div
    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4"
    role="alert"
  >
    <strong class="font-bold">Could not login:</strong>
    <span class="block sm:inline">{{ error }}</span>
  </div>
</template>

<script>
export default {
  props: ['error'],
}
</script>
