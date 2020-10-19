import './bootstrap'
import { InertiaProgress } from '@inertiajs/progress'
import { createApp, h } from 'vue'
import { App, plugin as interiaPlugin } from '@inertiajs/inertia-vue3'

InertiaProgress.init()

const el = document.getElementById('app')

const app = createApp({
  render: () =>
    h(App, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => {
        let path = name.split('/')
        path = path
          .map((file, i) => (i === path.length - 1 ? file : file.toLowerCase()))
          .join('/')
        return require(`./pages/${path}`).default
      },
    }),
}).use(interiaPlugin)

app.mixin({
  methods: {
    route: window.route,
  },
})

const files = require.context('./components/base', true, /\.vue$/i)
files.keys().map(key =>
  app.component(
    key
      .split('/')
      .pop()
      .split('.')[0],
    files(key).default,
  ),
)

const mapsAPI = document.createElement('script')
mapsAPI.src = `https://maps.googleapis.com/maps/api/js?key=${process.env.MIX_GOOGLE_MAPS_API_TOKEN}&callback=initMap`
mapsAPI.defer = true
document.body.appendChild(mapsAPI)

window.initMap = async function() {
  app.mount(el)
}
