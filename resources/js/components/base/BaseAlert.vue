<template>
  <div
    class="border px-4 py-3 rounded relative mt-4"
    :class="{
      'bg-red-100 border-red-400 text-red-700': color === 'red',
      'bg-green-100 border-green-400 text-green-700': color === 'green',
    }"
    role="alert"
  >
    <strong class="font-bold">{{ message1 }}&nbsp;</strong>
    <span class="block sm:inline">{{ message2 }}</span>
  </div>
</template>

<script>
export default {
  props: ['color', 'message1', 'message2'],
}
</script>
