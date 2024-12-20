<script setup lang="ts">
import { AspectRatio } from '@/components/ui/aspect-ratio'
import { Progress } from '@/components/ui/progress'
import { BrainCircuit, CheckCircle2, Dumbbell } from 'lucide-vue-next'

const props = defineProps<{
  progress: number
  lesson: Lesson
  modules: Module[]
}>()
</script>
<template>
  <div class="relative rounded-3xl shadow-taper">
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
        :src="
          props.lesson.thumbnail ??
          'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80'
        "
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
    <div class="w-full space-y-8 rounded-b-3xl border-x border-b bg-card p-6">
      <h3 class="line-clamp-2 text-wrap text-lg font-semibold">
        {{ props.lesson.title }}
      </h3>
      <p>{{ props.lesson.description }}</p>
      <div class="flex gap-6">
        <div class="flex items-center gap-2">
          <BrainCircuit :size="16" />
          <p>
            {{ props.modules.filter((e) => e.category == 'learn').length }}
            Lessons
          </p>
        </div>
        <div class="flex items-center gap-2">
          <Dumbbell :size="16" />
          <p>
            {{ props.modules.filter((e) => e.category == 'test').length }}
            Exercises
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
