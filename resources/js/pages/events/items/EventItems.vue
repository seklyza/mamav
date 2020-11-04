<template>
  <main-layout :title="event.name">
    <base-title>Items for {{ event.name }}</base-title>
    <form @submit.prevent="addItem">
      <input
        placeholder="Add a new item..."
        class="p-4 w-4/5 mr-4 shadow-md outline-none"
        :class="{ 'border border-red-500': newItem.error }"
        v-model.trim="newItem.val"
      />
      <button class="p-3 bg-primary hover:bg-blue-800 text-white rounded-lg">
        Add
      </button>
      <p v-if="newItem.error" class="mt-3 text-red-500">{{ newItem.error }}</p>
    </form>
    <ul class="mt-8">
      <li
        v-for="item in event.items"
        :key="item.id"
        class="mb-4 p-4 border shadow-md"
      >
        <div class="inline">
          <span class="font-semibold">
            <span class="text-green-500">{{ item.quantity }}</span>
            {{ item.name }}&nbsp;
          </span>
          <span v-if="item.description" class="text-gray-600">
            {{ item.description }}
          </span>
        </div>
        <x-icon
          class="w-5 inline cursor-pointer text-red-500 float-right"
          @click="removeItem(item)"
        ></x-icon>
      </li>
    </ul>
  </main-layout>
</template>

<script lang="ts">
import { PropType, reactive, toRefs } from 'vue'
import { Event } from '@/types'
import { Inertia } from '@inertiajs/inertia'

export default {
  props: {
    event: {
      type: Object as PropType<Event>,
      required: true,
    },
  },
  setup(props) {
    const form = reactive({
      newItem: {
        val: '',
        error: null,
      },
    })

    function addItem() {
      if (!form.newItem.val) {
        form.newItem.error = 'This field is required.'
        return
      }

      form.newItem.error = null
      const formData = { name: form.newItem.val }
      form.newItem.val = ''

      Inertia.post(route('events.items.store', props.event.id), formData)
    }

    function removeItem(item: Event['items'][number]) {
      if (confirm(`Are you sure you want to remove ${item.name}?`)) {
        Inertia.delete(
          route('events.items.delete', {
            event: props.event.id,
            item: item.id,
          }).toString(),
        )
      }
    }

    return {
      ...toRefs(form),

      addItem,
      removeItem,
    }
  },
}
</script>
