<template>
  <div>
    <the-navbar></the-navbar>
    <div class="ml-16 mt-12">
      <slot></slot>
    </div>
  </div>
</template>

<script>
import TheNavbar from '../../nav/TheNavbar'

export default {
  components: {
    TheNavbar,
  },
}
</script>
