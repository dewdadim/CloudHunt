<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { reactive } from 'vue'
import CourseList from '@/components/CourseList.vue'

const { courses } = defineProps<{
  courses: Course[]
}>()
</script>

<template>
  <main class="mt-16 grid gap-4">
    <section class="my-8">
      <CourseList title="Add text here" :courses="courses" :grid-cols="3" />
    </section>
    <section class="my-8">
      <CourseList title="Add text here" :courses="courses" :grid-cols="3" />
    </section>
    <section class="my-8">
      <CourseList title="Add text here" :courses="courses" :grid-cols="3" />
    </section>
  </main>
</template>
