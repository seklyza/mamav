import { Inertia } from '@inertiajs/inertia'

export function useCreateEvent() {
  function visitCreateEvent() {
    Inertia.visit(route('events.create'))
  }

  return {
    visitCreateEvent,
  }
}
