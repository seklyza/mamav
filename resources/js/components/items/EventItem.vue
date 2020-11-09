<template>
  <li class="mb-4 p-4 border shadow-md">
    <div class="inline">
      <form
        v-if="canUpdate"
        v-show="isEditing"
        class="inline-block"
        @submit.prevent="onSubmit"
      >
        <input
          type="number"
          min="1"
          class="outline-none shadow-xs w-8 mr-2 text-red-500"
          :value="item.quantity || 1"
          ref="quantityInput"
          autocomplete="off"
        />
      </form>
      <span class="font-semibold">
        <span v-if="item.quantity !== 1 && !isEditing" class="text-green-500">
          {{ item.quantity }}
        </span>
        {{ item.name }}&nbsp;
      </span>
      <span v-if="item.description" class="text-gray-600">
        {{ item.description }}
      </span>
    </div>
    <div v-if="!isEditing && canUpdate" class="inline float-right">
      <pencil-icon
        @click="setEditing"
        class="w-5 inline cursor-pointer text-green-500"
      ></pencil-icon>
      <x-icon
        class="w-5 inline cursor-pointer text-red-500"
        @click="removeItem(item)"
      ></x-icon>
    </div>
    <div v-else-if="canUpdate" class="inline float-right">
      <x-icon
        class="w-5 inline cursor-pointer text-red-500"
        @click="isEditing = false"
      ></x-icon>
    </div>
  </li>
</template>

<script lang="ts">
import { defineComponent, PropType, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { Item } from '@/types'

export default defineComponent({
  props: {
    eventId: {
      type: Number,
      required: true,
    },
    item: {
      type: Object as PropType<Item>,
      required: true,
    },
    canUpdate: {
      type: Boolean,
      required: true,
    },
  },
  setup(props) {
    const isEditing = ref(false)
    const quantityInput = ref<HTMLInputElement>()

    function removeItem(item: Item) {
      if (confirm(`Are you sure you want to remove ${item.name}?`)) {
        Inertia.delete(
          route('events.items.delete', {
            event: props.eventId,
            item: item.id,
          }),
        )
      }
    }

    function setEditing() {
      isEditing.value = true
      setTimeout(() => {
        quantityInput.value?.focus()
      }, 50)
    }

    function onSubmit() {
      isEditing.value = false
      Inertia.put(
        route('events.items.update-quantity', {
          event: props.eventId,
          item: props.item.id,
        }),
        { quantity: quantityInput.value!.value },
      )
    }

    return {
      isEditing,
      quantityInput,
      setEditing,

      removeItem,
      onSubmit,
    }
  },
})
</script>
