<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Progress } from '@/components/ui/progress'
import { Link } from '@inertiajs/vue3'
import { X } from 'lucide-vue-next'
import { computed, defineAsyncComponent, ref, shallowRef } from 'vue'

const { lesson, module } = defineProps<{
  lesson: Lesson
  module: Module
}>()

const currentTask = ref(1)
const totalTasks = ref(0)

const handleProgressUpdate = (current: number, total: number) => {
  currentTask.value = current
  totalTasks.value = total
}

const component = shallowRef<ReturnType<typeof defineAsyncComponent> | null>(
  null,
)

try {
  component.value = defineAsyncComponent(
    () =>
      import(`../../components/lessons/${lesson.uri}/${module.uri}/index.vue`),
  )
} catch (error) {
  console.error('Error loading component: ', error)
}

// Calculate the progress percentage based on the current step
const progressPercentage = computed(() => {
  if (totalTasks.value === 0) return 0
  return Math.min((currentTask.value / totalTasks.value) * 100, 100)
})
const progress = computed(() => progressPercentage.value)

// Update progress text computation
const progressText = computed(() => {
  if (totalTasks.value === 0) return '1/1'
  return `${currentTask.value}/${totalTasks.value}`
})
</script>
<template>
  <div
    class="fixed left-0 right-0 top-0 z-50 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60"
  >
    <div class="flex h-16 items-center gap-4 px-4 md:px-56">
      <Link
        :href="route('lessons.show', { lesson: lesson.uri })"
        method="get"
        as="button"
        class="rounded-lg p-1 hover:bg-muted"
      >
        <X :size="24" />
      </Link>

      <div class="flex grow items-center gap-3">
        <Progress v-model="progress" class="h-2.5 grow" />
        <span class="text-sm font-medium">
          {{ progressText }}
        </span>
      </div>
    </div>
  </div>
  <MaxWidthWrapper class="pt-20 md:max-w-screen-md">
    <main>
      <component
        :is="component"
        v-if="component"
        v-bind="{ lesson, module }"
        @update-progress="handleProgressUpdate"
      />
      <p v-else>Component not found</p>
    </main>
  </MaxWidthWrapper>
</template>
