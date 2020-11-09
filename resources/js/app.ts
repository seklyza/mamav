import './bootstrap'
import { InertiaProgress } from '@inertiajs/progress'
import { createApp, h } from 'vue'
import { App, plugin as interiaPlugin } from '@inertiajs/inertia-vue3'

InertiaProgress.init()

const el = document.getElementById('app')!

const app = createApp({
  render: () =>
    h(App, {
      initialPage: JSON.parse(el.dataset.page!),
      resolveComponent(name: string) {
        let paths = name.split('/')
        const path = paths
          .map((path, i) =>
            i === paths.length - 1 ? path : path.toLowerCase(),
          )
          .join('/')

        return import(`./pages/${path}`).then(m => m.default)
      },
    }),
}).use(interiaPlugin)

app.mixin({ methods: { route } })

const files = require.context('./components/base', true, /\.vue$/i)
files
  .keys()
  .map(key =>
    app.component(key.split('/').pop()!.split('.')[0], files(key).default),
  )

if (process.env.MIX_GOOGLE_MAPS_ENABLED === 'true') {
  const mapsAPI = document.createElement('script')
  mapsAPI.src = `https://maps.googleapis.com/maps/api/js?key=${process.env.MIX_GOOGLE_MAPS_API_TOKEN}&callback=initMap`
  mapsAPI.defer = true
  document.body.appendChild(mapsAPI)

  void ((window as any).initMap = () => {
    app.mount(el)
  })
} else {
  void ((window as any).google = {
    maps: {
      Geocoder: class {
        geocode() {}
      },
    },
  }) // mock google API for development
  app.mount(el)
}
