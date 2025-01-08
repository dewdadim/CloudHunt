<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Button } from '@/components/ui/button'
import { Link, usePage } from '@inertiajs/vue3'
import { CheckCircle2, Clock, Crosshair, Stars, Timer } from 'lucide-vue-next'
import { onMounted } from 'vue'

const props = defineProps<{
  lesson: Lesson
  module: Module
  time_spent: number
  accuracy: number
  xp_earned: number
}>()

const user = usePage().props.auth.user

const formatTime = (seconds: number) => {
  const hours = Math.floor(seconds / 3600)
  const minutes = Math.floor((seconds % 3600) / 60)
  const remainingSeconds = seconds % 60

  if (hours > 0) {
    return `${hours}h ${minutes}m ${remainingSeconds}s`
  } else if (minutes > 0) {
    return `${minutes}m ${remainingSeconds}s`
  } else {
    return `${remainingSeconds}s`
  }
}

onMounted(() => {
  const audio = new Audio('/sounds/level-passed.mp3')
  audio.volume = 0.2
  audio.play().catch((error) => {
    console.warn('Sound effect could not be played:', error)
  })
})
</script>

<template>
  <MaxWidthWrapper
    class="mt-20 flex flex-col items-center justify-center gap-10 text-center md:mt-32"
  >
    <CheckCircle2 :size="150" class="text-primary"></CheckCircle2>
    <div class="flex flex-col items-center gap-6">
      <div class="space-y-2">
        <h2 class="text-4xl font-semibold">
          {{ props.module.category == 'learn' ? 'Lesson' : 'Exercise' }}
          Complete
        </h2>
        <p class="text-lg font-medium">
          Great progress {{ user?.prefer_name }}! Keep the momentum to keep
          improving.
        </p>
      </div>
      <div class="flex gap-4">
        <div
          v-if="props.xp_earned"
          class="flex flex-col gap-2 rounded-xl bg-accent/60 p-4"
        >
          <p class="flex items-center gap-2 text-2xl">
            <Stars :size="28" /> {{ props.xp_earned }}
          </p>
          <p class="text-muted-foreground">XP Earned</p>
        </div>
        <div
          v-if="props.accuracy"
          class="flex flex-col gap-2 rounded-xl bg-accent/60 p-4"
        >
          <p class="flex items-center gap-2 text-2xl">
            <Crosshair :size="28" /> {{ props.accuracy }}%
          </p>
          <p class="text-muted-foreground">Accuracy</p>
        </div>
        <div
          v-if="props.time_spent"
          class="flex flex-col gap-2 rounded-xl bg-accent/60 p-4"
        >
          <p class="flex items-center gap-2 text-2xl">
            <Clock :size="28" /> {{ formatTime(props.time_spent) }}
          </p>
          <p class="text-muted-foreground">Time</p>
        </div>
      </div>
      <div class="mt-6 grid grid-cols-1 gap-1">
        <Link
          :href="
            route('lessons.show', {
              lesson: props.lesson.uri,
            })
          "
        >
          <Button size="lg">Back to Roadmap</Button>
        </Link>
        <Link
          :href="
            route('modules.show', {
              lesson: props.lesson.uri,
              module: props.module.uri,
            })
          "
        >
          <Button size="lg" variant="link">Retake</Button>
        </Link>
      </div>
    </div>
  </MaxWidthWrapper>
</template>
