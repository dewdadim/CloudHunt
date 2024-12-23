<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Progress } from '@/components/ui/progress'
import { Link } from '@inertiajs/vue3'
import { X } from 'lucide-vue-next'
import { computed, ref, onMounted } from 'vue'
import ModuleFinishButton from '@/components/ModuleFinishButton.vue'
import { Button } from '@/components/ui/button'

const props = defineProps<{
  lesson: Lesson
  module: Module
}>()

const currentTask = ref(1)
const totalTasks = ref(0)
const visibleTasks = ref(1)
const tasks = ref<any[]>([])

// Load both the main component and tasks dynamically
onMounted(async () => {
  try {
    // Load tasks from index.ts
    const taskModules = await import(
      `../../components/lessons/${props.lesson.uri}/${props.module.uri}/index.ts`
    )
    tasks.value = Object.values(taskModules)

    // Update progress
    totalTasks.value = tasks.value.length
    currentTask.value = 1
  } catch (error) {
    console.error('Error loading tasks:', error)
    tasks.value = []
  }
})

const handleTaskComplete = () => {
  if (visibleTasks.value < tasks.value.length) {
    visibleTasks.value++
    currentTask.value++

    setTimeout(() => {
      const sections = document.querySelectorAll('#task-container')
      const lastSection = sections[sections.length - 1]
      lastSection?.scrollIntoView({ behavior: 'smooth' })
    }, 0)
  }
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
    <MaxWidthWrapper>
      <div class="flex h-16 items-center gap-4">
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
    </MaxWidthWrapper>
  </div>
  <MaxWidthWrapper class="pt-20 md:max-w-screen-md">
    <main>
      <div v-if="tasks.length" class="space-y-10">
        <section
          id="task-container"
          v-for="(task, index) in tasks.slice(0, visibleTasks)"
          :key="index"
          class="flex min-h-[calc(100vh-80px)] flex-col justify-start py-20"
        >
          <component :is="task" />
          <div class="mt-6 flex gap-4">
            <ModuleFinishButton
              v-if="index === visibleTasks - 1 && index === tasks.length - 1"
              :lesson="lesson"
              :module="module"
            />
            <Button
              variant="secondary"
              size="lg"
              v-if="index === visibleTasks - 1 && currentTask < totalTasks"
              @click="handleTaskComplete"
            >
              Next Task
            </Button>
          </div>
        </section>
      </div>
      <p v-else>No tasks found</p>
    </main>
  </MaxWidthWrapper>
</template>
