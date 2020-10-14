import './bootstrap'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import Vue from 'vue'
import VueCompositionAPI from '@vue/composition-api'

InertiaProgress.init()
Vue.use(InertiaApp)
Vue.use(VueCompositionAPI)

Vue.mixin({
  methods: {
    route: window.route,
  },
})

const files = require.context('./components/base', true, /\.vue$/i)
files.keys().map(key =>
  Vue.component(
    key
      .split('/')
      .pop()
      .split('.')[0],
    files(key).default,
  ),
)

const app = document.getElementById('app')

const vueApp = new Vue({
  render: h =>
    h(InertiaApp, {
      props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: name => require(`./pages/${name}`).default,
      },
    }),
})

const mapsAPI = document.createElement('script')
mapsAPI.src = `https://maps.googleapis.com/maps/api/js?key=${process.env.MIX_GOOGLE_MAPS_API_TOKEN}&callback=initMap`
mapsAPI.defer = true
document.body.appendChild(mapsAPI)

window.initMap = async function() {
  vueApp.$mount(app)
}
