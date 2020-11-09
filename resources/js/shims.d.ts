declare module '*.vue' {
  import { defineComponent } from 'vue'
  const component: ReturnType<typeof defineComponent>
  export default component
}

declare module '@inertiajs/progress'

declare module '@inertiajs/inertia-vue3' {
  export const App, plugin
  export function usePage<T>(): import('@inertiajs/inertia').PageProps<{
    value: T & { errors: string[] }
  }> {}
}

declare const route: any
