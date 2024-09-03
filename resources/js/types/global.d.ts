import { PageProps as InertiaPageProps } from '@inertiajs/core'
import { AxiosInstance } from 'axios'
import { PageProps as AppPageProps } from './'
import ziggyRouteFunction from '@types/ziggy-js'

declare global {
  interface Window {
    axios: AxiosInstance
  }
  const route: typeof ziggyRouteFunction
  interface Onboard {
    full_name: string
    date_of_birth: Date | string
    occupation: string
    interest?: string
  }
}

declare module '@inertiajs/core' {
  interface PageProps extends InertiaPageProps, AppPageProps {}
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    route: typeof ziggyRouteFunction
  }
}
