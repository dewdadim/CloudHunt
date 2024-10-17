<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { reactive } from 'vue'
import LessonList from '@/components/LessonList.vue'
import LessonCard from '@/components/LessonCard.vue'

const { lessons } = defineProps<{
  lessons: Lesson[]
}>()
</script>

<template>
  <main class="mt-10 grid gap-4">
    <h2 class="mb-4 text-xl font-semibold">List of available courses</h2>
    <div class="grid grid-cols-3 gap-4">
      <div v-for="lesson in lessons">
        <LessonCard class="w-full" :lesson="lesson" />
      </div>
    </div>
  </main>
</template>
