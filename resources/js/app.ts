import './bootstrap'
import '../css/app.css'
import '../css/noise.css'

import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import LayoutDefault from './Layouts/LayoutDefault.vue'

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page: any = pages[`./Pages/${name}.vue`]
    page.default.layout =
      name.startsWith('Onboard/') ||
      name.startsWith('Lesson/') ||
      name.startsWith('Auth/')
        ? undefined
        : LayoutDefault
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
