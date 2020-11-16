declare module '*.vue' {
  import { defineComponent } from 'vue'
  const component: ReturnType<typeof defineComponent>
  export default component
}

type PageProps<T> = T & {
  errors: { [key: string]: string }
  auth: { user?: import('@/types').User }
  flash: { message?: string }
  success?: boolean
}

declare module '@inertiajs/inertia-vue3' {
  import { ComputedRef } from 'vue'
  export const App, plugin
  export function usePage<T>(): import('@inertiajs/inertia').Page<
    ComputedRef<PageProps<T>>
  > {}
}

declare module 'ziggy'

declare const route: any
