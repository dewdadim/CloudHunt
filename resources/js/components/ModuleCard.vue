<script setup lang="ts">
import { cn } from '@/lib/utils'
import { MonitorPlay, MousePointerClick, Puzzle } from 'lucide-vue-next'

const { course } = defineProps<{
  course: Course
  chapters: Chapter[]
  module: Module
  index: number
  currentChapter: number
}>()
</script>

<template>
  <Link
    :href="
      route('modules.show', {
        course: course.uri,
        chapter: chapters[currentChapter].uri,
        module: module.uri,
      })
    "
    :class="
      cn(
        'group relative flex h-56 items-center transition hover:-translate-y-2 hover:cursor-pointer',
        index % 2 !== 0 ? 'order-last' : 'order-first justify-end',
      )
    "
  >
    <div
      :class="
        cn(
          'flex h-full w-48 flex-col items-center justify-center gap-3 rounded-3xl bg-card p-2 text-center transition',
          module.isDone
            ? 'border-4 border-primary bg-yellow-50 text-primary shadow-lg shadow-primary'
            : 'border text-slate-600 shadow-taper group-hover:bg-slate-50',
        )
      "
    >
      <component
        :is="
          module.category == 'video'
            ? MonitorPlay
            : module.category == 'quiz'
              ? Puzzle
              : MousePointerClick
        "
        class="size-14 stroke-[1.2px]"
      />
      <h3 class="text-wrap font-semibold">{{ module.title }}</h3>
    </div>
  </Link>
</template>
