<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Progress } from '@/components/ui/progress'
import { cn } from '@/lib/utils'
import { X } from 'lucide-vue-next'
import { computed, defineAsyncComponent, ref, shallowRef } from 'vue'

const { lesson, module } = defineProps<{
  lesson: Lesson
  module: Module
}>()

//////////////////////////////////////////////////////////////////////////////
const component = shallowRef<ReturnType<typeof defineAsyncComponent> | null>(
  null,
)

try {
  component.value = defineAsyncComponent(
    () => import(`../../components/lessons/${lesson.uri}/${module.uri}.vue`),
  )
} catch (error) {
  console.error('Error loading component: ', error)
}
//////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////
// Handle the task update event from the child
const totalTasks = ref(0)
const currentTask = ref(0)

// Function to set the total number of tasks
const setTotalTasks = (total: any) => {
  totalTasks.value = total
}

// Function to set the current task
const setCurrentTask = (current: any) => {
  currentTask.value = current
}

// Calculate the progress percentage based on the current step
const progressPercentage = computed(() => {
  return ((currentTask.value + 1) / totalTasks.value) * 100
})
const progress = ref(progressPercentage)
//////////////////////////////////////////////////////////////////////////////
</script>
<template>
  <main>
    <MaxWidthWrapper class="pt-10">
      <div class="flex items-center gap-4">
        <X
          :class="
            cn(
              'flex-none',
              !currentTask ? 'cursor-not-allowed' : 'cursor-pointer',
            )
          "
          :size="28"
          :disabled="currentTask"
        />
        <Progress v-model="progress" class="w-6 grow" />
      </div>
      <component
        :is="component"
        v-if="component"
        v-bind="{ lesson, module }"
        @total-tasks="setTotalTasks"
        @current-task="setCurrentTask"
      />
      <p v-else>Component not found</p>
    </MaxWidthWrapper>
  </main>
</template>
