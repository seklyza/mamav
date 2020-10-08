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
    $route: (...args) => window.route(...args),
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

new Vue({
  render: h =>
    h(InertiaApp, {
      props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: name => require(`./pages/${name}`).default,
      },
    }),
}).$mount(app)
