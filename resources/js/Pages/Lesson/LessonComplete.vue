<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Button } from '@/components/ui/button'
import { Link, usePage } from '@inertiajs/vue3'
import { CheckCircle2 } from 'lucide-vue-next'
import { onMounted } from 'vue'

const props = defineProps<{
  lesson: Lesson
  module: Module
}>()

const user = usePage().props.auth.user

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
    class="mt-24 flex flex-col items-center justify-center gap-10 md:mt-52"
  >
    <CheckCircle2 :size="150" class="text-primary"></CheckCircle2>
    <div class="flex flex-col items-center gap-4">
      <h2 class="text-4xl font-semibold">Lesson Complete</h2>
      <p class="text-lg font-medium">
        Great progress {{ user?.prefer_name }}! Keep the momentum to keep
        improving.
      </p>
      <Link
        :href="
          route('lessons.show', {
            lesson: props.lesson.uri,
          })
        "
      >
        <Button size="lg" class="font-semibold">Continue</Button>
      </Link>
    </div>
  </MaxWidthWrapper>
</template>
