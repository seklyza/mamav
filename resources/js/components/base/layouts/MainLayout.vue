<template>
  <div>
    <the-navbar></the-navbar>
    <div class="mx-6 my-6">
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
  props: ['title'],
  created() {
    if (this.title) {
      document.title = `${this.title} - MaMaV`
    } else {
      document.title = 'MaMaV'
    }
  },
}
</script>
