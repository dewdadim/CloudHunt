<script setup lang="ts">
import { computed, HTMLAttributes, ref } from 'vue'
import { AspectRatio } from './ui/aspect-ratio'
import { cn } from '@/lib/utils'
import { Link } from '@inertiajs/vue3'
import { Progress } from './ui/progress'
import { Brain, CheckCheck, CheckCircle2, Pencil } from 'lucide-vue-next'

const props = defineProps<{
  class?: HTMLAttributes['class']
  lesson: Lesson
}>()

// Calculate the progress percentage based on the current step
const progressPercentage = computed(() => {
  return (
    (props.lesson.modules.filter((e) => e.completed == true).length /
      props.lesson.modules.length) *
    100
  )
})

const progress = ref(progressPercentage ?? 0)
</script>

<template>
  <div :class="cn('relative w-72 rounded-3xl shadow-taper', props.class)">
    <Link :href="route('lessons.show', { lesson: props.lesson?.uri })">
      <!-- status badge -->
      <div
        class="absolute left-2.5 top-2.5 z-10 flex w-fit items-center gap-1 rounded-full bg-yellow-100/40 px-3 py-2 text-xs font-semibold text-yellow-500"
        v-if="progress >= 100"
      >
        <CheckCircle2 :size="16" :stroke-width="2.5" />
        Completed
      </div>

      <AspectRatio :ratio="7 / 3" class="rounded-3xl bg-muted">
        <img
          src="https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80"
          alt="Photo by Drew Beamer"
          class="h-full w-full rounded-t-3xl border-x border-t object-cover"
        />
        <div
          class="h-fit w-full border-l border-r"
          v-if="progress < 100 && progress > 0"
        >
          <Progress :modelValue="progress" class="h-1 rounded-none" />
        </div>
      </AspectRatio>
      <div
        class="h-16 w-full rounded-b-3xl border-x border-b bg-card px-3 py-1.5"
      >
        <h3 class="text-md line-clamp-2 text-wrap font-semibold">
          {{ props.lesson.title }}
        </h3>
      </div>
    </Link>
  </div>
</template>
