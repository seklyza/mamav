<template>
  <div class="flex flex-col pt-4">
    <label :for="name" class="text-lg">{{ label }}</label>
    <input
      :type="type"
      :id="name"
      :placeholder="label"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
      :class="{
        'border-red-500': $page.props.errors[name] && showErrors,
      }"
      autocomplete="off"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :max="max"
    />
    <p v-if="showErrors" class="text-red-500">{{ $page.props.errors[name] }}</p>
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
    modelValue: String,
    showErrors: {
      type: Boolean,
      default: true,
    },
    max: String,
  },
  emits: ['update:modelValue'],
}
</script>
