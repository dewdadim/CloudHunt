<script setup lang="ts">
import { cn } from '@/lib/utils'
import { MonitorPlay, MousePointerClick, Puzzle } from 'lucide-vue-next'
import { HTMLAttributes, ref } from 'vue'
import { Popover, PopoverContent, PopoverTrigger } from './ui/popover'
import { Button } from './ui/button'
import { Link } from '@inertiajs/vue3'

const props = defineProps<{
  module: Module
  progress: Progress
  lessonUri: string
  class?: HTMLAttributes['class']
}>()
</script>

<template>
  <Popover>
    <PopoverTrigger
      :class="
        cn(
          'flex h-full w-40 flex-col items-center justify-center gap-3 rounded-3xl bg-card p-6 text-center transition',
          props?.progress[props.module.id]?.completed
            ? 'border-4 border-primary bg-yellow-50 text-primary shadow-lg shadow-primary'
            : 'border text-slate-600 shadow-taper group-hover:bg-slate-50',
        )
      "
    >
      <component
        :is="
          props.module.category == 'learn'
            ? MonitorPlay
            : props.module.category == 'test'
              ? Puzzle
              : MousePointerClick
        "
        class="size-14 stroke-[1.2px]"
      />
      <h3 class="text-wrap text-sm font-semibold">
        {{ props.module.title }}
      </h3>
    </PopoverTrigger>
    <PopoverContent side="bottom">
      <div class="grid gap-4">
        <h4 class="font-semibold">{{ props.module.title }}</h4>
        <Link
          :href="
            route('modules.show', {
              lesson: props.lessonUri,
              module: props.module.uri,
            })
          "
          class="w-full"
        >
          <Button class="w-full">Start Lesson</Button>
        </Link>
      </div>
    </PopoverContent>
  </Popover>
</template>
