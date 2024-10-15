<script setup lang="ts">
import { computed, HTMLAttributes, ref } from 'vue'
import { AspectRatio } from './ui/aspect-ratio'
import { cn } from '@/lib/utils'
import { Link } from '@inertiajs/vue3'
import { Progress } from './ui/progress'

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
const progress = ref(progressPercentage)
console.log(props.lesson.modules.length)
console.log(props.lesson)
</script>

<template>
  <div :className="cn('w-72 rounded-3xl shadow-taper', props.class)">
    <Link :href="route('lessons.show', { lesson: props.lesson?.uri })">
      <AspectRatio :ratio="7 / 3" class="rounded-3xl bg-muted">
        <img
          src="https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80"
          alt="Photo by Drew Beamer"
          class="h-full w-full rounded-t-3xl border-x border-t object-cover"
        />
      </AspectRatio>
      <div class="h-fit w-full border-l border-r">
        <Progress :modelValue="progress" class="h-1 rounded-none" />
      </div>
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
