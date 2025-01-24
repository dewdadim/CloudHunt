<script setup lang="ts">
import { computed, HTMLAttributes, ref } from 'vue'
import { AspectRatio } from './ui/aspect-ratio'
import { cn } from '@/lib/utils'
import { Link } from '@inertiajs/vue3'
import { Progress } from './ui/progress'
import { Brain, CheckCheck, CheckCircle2, Pencil } from 'lucide-vue-next'
import { Button } from './ui/button'

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
</script>

<template>
  <div class="space-y-4">
    <h3 class="text-xl font-semibold">Jump back in!</h3>

    <div :class="cn('relative w-full rounded-3xl shadow-taper', props.class)">
      <AspectRatio :ratio="8 / 3" class="rounded-3xl bg-muted">
        <img
          :src="
            props.lesson.thumbnail ??
            'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80'
          "
          alt="Photo by Drew Beamer"
          class="h-full w-full rounded-t-3xl border-x border-t object-cover"
        />
        <div class="h-fit w-full border-l border-r" v-if="progress < 100">
          <Progress :modelValue="progress" class="h-1 rounded-none" />
        </div>
      </AspectRatio>
      <div class="h-fit w-full rounded-b-3xl border-x border-b bg-card p-8">
        <h3
          class="mb-8 line-clamp-2 text-wrap text-center text-xl font-semibold"
        >
          {{ props.lesson.title }}
        </h3>
        <Link :href="route('lessons.show', { lesson: props.lesson?.uri })">
          <Button class="w-full">Continue</Button>
        </Link>
      </div>
    </div>
  </div>
</template>
