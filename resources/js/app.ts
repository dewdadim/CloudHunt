import './bootstrap'
import '../css/app.css'
import '../css/noise.css'

import { createApp, DefineComponent, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import Layout from './Layouts/Layout.vue'

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page: any = pages[`./Pages/${name}.vue`]
    page.default.layout =
      name.startsWith('Onboard') ||
      name.startsWith('Course/') ||
      name.startsWith('Auth/')
        ? undefined
        : Layout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(autoAnimatePlugin)
      .component('Head', Head)
      .component('Link', Link)
      .mount(el)
  },
  progress: {
    delay: 250,
    color: '#F9BF3B',
    includeCSS: true,
    showSpinner: false,
  },
})
