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
    full_name: string | undefined
    prefer_name: string | undefined
    // username: string | undefined
    date_of_birth: DateValue | DateValue[] | undefined
    occupation: string | undefined
    interest?: string | undefined
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
