<template>
  <component
    :is="btnType"
    class="bg-primary rounded text-white font-bold text-lg hover:bg-blue-800 p-2 mt-8"
  >
    <slot></slot>
  </component>
</template>

<script>
export default {
  props: {
    btnType: {
      type: String,
      required: false,
      default: 'button',
    },
  },
}
</script>
