<script setup lang="ts">
import { cn } from '@/lib/utils'
import { BrainCircuit, CheckCircle2, Dumbbell } from 'lucide-vue-next'

const props = defineProps<{
  lesson: Lesson
  modules: Module[]
}>()
</script>

<template>
  <Link
    :href="
      route('modules.show', {
        lesson: props.lesson.uri,
        module: module.uri,
      })
    "
    v-for="module in props.modules"
    :class="
      cn(
        'flex h-20 items-center justify-between rounded-2xl px-8',
        module.completed
          ? 'border-2 border-primary bg-yellow-50 text-primary shadow-[-1px_3px_4px_0px_rgba(249,191,57,1)]'
          : 'border bg-card shadow-taper',
      )
    "
  >
    <div class="flex items-center gap-4">
      <BrainCircuit v-if="module.category === 'learn'" />
      <Dumbbell v-else />
      <h3 class="font-medium">{{ module.title }}</h3>
    </div>
    <CheckCircle2
      :size="32"
      :class="module.completed ? 'text-primary' : 'text-gray-300'"
    />
  </Link>
</template>
