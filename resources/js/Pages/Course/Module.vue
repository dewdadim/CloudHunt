<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { defineAsyncComponent, onMounted, ref, shallowRef } from 'vue'

const { course, chapter, module } = defineProps<{
  course: Course
  chapter: Chapter
  module: Module
}>()

const component = shallowRef<ReturnType<typeof defineAsyncComponent> | null>(
  null,
)

try {
  component.value = defineAsyncComponent(
    () =>
      import(
        `../../components/courses/${course.uri}/${chapter.uri}/${module.uri}.vue`
      ),
  )
} catch (error) {
  console.error('Error loading component: ', error)
}
</script>
<template>
  <MaxWidthWrapper class="pt-40">
    <component :is="component" v-if="component" />
    <p v-else>Component not found</p>
  </MaxWidthWrapper>
</template>
