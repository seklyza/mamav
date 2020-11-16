<template>
  <main-layout :title="event.name">
    <base-title>Items for {{ event.name }}</base-title>
    <form @submit.prevent="addItem" v-if="canUpdate">
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
      <event-item
        v-for="item in event.items || []"
        :key="item.id"
        :event-id="event.id"
        :item="item"
        :can-update="canUpdate"
      ></event-item>
    </ul>
  </main-layout>
</template>

<script lang="ts">
import { defineComponent, PropType, reactive, toRefs } from 'vue'
import { Event } from '@/types'
import { Inertia } from '@inertiajs/inertia'

import EventItem from '@/components/items/EventItem.vue'

export default defineComponent({
  components: {
    EventItem,
  },
  props: {
    event: {
      type: Object as PropType<Event>,
      required: true,
    },
    canUpdate: {
      type: Boolean,
      required: true,
    },
  },
  setup(props) {
    const form = reactive<{ newItem: { val: string; error: string | null } }>({
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

    return {
      ...toRefs(form),

      addItem,
    }
  },
})
</script>
