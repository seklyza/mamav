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

type Routes = keyof typeof import('@/generated/ziggy').Ziggy['routes']
declare const route: ((name: Routes, params?: any) => string) &
  (() => { current: (name: Routes) => boolean } & { current: () => Routes })
