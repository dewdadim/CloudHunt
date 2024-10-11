<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { reactive } from 'vue'
import LessonList from '@/components/LessonList.vue'

const { lessons } = defineProps<{
  lessons: Lesson[]
}>()
</script>

<template>
  <main class="mt-16 grid gap-4">
    <section class="my-8">
      <LessonList title="Add text here" :lessons="lessons" :grid-cols="3" />
    </section>
    <section class="my-8">
      <LessonList title="Add text here" :lessons="lessons" :grid-cols="3" />
    </section>
    <section class="my-8">
      <LessonList title="Add text here" :lessons="lessons" :grid-cols="3" />
    </section>
  </main>
</template>
