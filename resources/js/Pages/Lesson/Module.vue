<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { defineAsyncComponent, shallowRef } from 'vue'

const { lesson, module } = defineProps<{
  lesson: Lesson
  module: Module
}>()

const component = shallowRef<ReturnType<typeof defineAsyncComponent> | null>(
  null,
)

try {
  component.value = defineAsyncComponent(
    () => import(`../../components/lessons/${lesson.uri}/${module.uri}.vue`),
  )
} catch (error) {
  console.error('Error loading component: ', error)
}
</script>
<template>
  <MaxWidthWrapper class="pt-10">
    <component :is="component" v-if="component" v-bind="{ lesson, module }" />
    <p v-else>Component not found</p>
  </MaxWidthWrapper>
</template>
