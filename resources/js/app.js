import './bootstrap'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import Vue from 'vue'

InertiaProgress.init()
Vue.use(InertiaApp)

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
