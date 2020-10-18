<template>
  <div class="flex flex-col pt-4">
    <label :for="name" class="text-lg">{{ label }}</label>
    <textarea
      :id="name"
      :placeholder="label"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline resize-none"
      :class="{
        'border-red-500': $page.props.errors[name],
      }"
      autocomplete="off"
      :value="modelValue"
      :rows="rows"
      :cols="cols"
      @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
    <p class="text-red-500">{{ $page.props.errors[name] }}</p>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    rows: String,
    cols: String,
    label: String,
    modelValue: String,
  },
  emits: ['update:modelValue'],
}
</script>
