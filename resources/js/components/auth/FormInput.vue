<template>
  <div class="flex flex-col pt-4">
    <label :for="name" class="text-lg">{{ label }}</label>
    <input
      :type="type"
      :id="name"
      :placeholder="label"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
      autocomplete="off"
      :class="{
        'border-red-700': error || $page.errors[name],
      }"
      :value="value"
      @input="$emit('input', $event.target.value)"
      @blur="$emit('clear-validity', name)"
    />
    <p v-if="error || $page.errors[name]" class="text-red-700">
      {{ error || $page.errors[name] }}
    </p>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    type: {
      type: String,
      required: false,
      default: 'text',
    },
    label: String,
    value: String,
    error: String,
  },
  emits: ['clear-validity'],
}
</script>
