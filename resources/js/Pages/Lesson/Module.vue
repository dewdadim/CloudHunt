<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Progress } from '@/components/ui/progress'
import { Link, router } from '@inertiajs/vue3'
import { CheckCircle, CheckCircle2, X, XCircle } from 'lucide-vue-next'
import { computed, ref, onMounted, reactive } from 'vue'
import { Button } from '@/components/ui/button'
import { cn } from '@/lib/utils'

const props = defineProps<{
  lesson: Lesson
  module: Module
}>()

const correctSound = new Audio('/sounds/correct.mp3')
const wrongSound = new Audio('/sounds/false.mp3')
correctSound.volume = 0.6
wrongSound.volume = 0.4

const currentTask = ref(1)
const totalTasks = ref(0)
const visibleTasks = ref(1)
const tasks = ref<any[]>([])
const taskCompleted = ref(false)
const taskResponse = ref<TaskResponse>()
const xp = ref(0)
const startTime = ref<number>(0)
const endTime = ref<number>(0)

// Add this computed property to check if it's a test module
const isTestModule = computed(() => props.module.category === 'test')

// Load both the main component and tasks dynamically
onMounted(async () => {
  try {
    // Start the timer when component mounts
    startTime.value = Date.now()

    // Load tasks from index.ts
    const taskModules = await import(
      `../../components/lessons/${props.lesson.uri}/${props.module.uri}/index.ts`
    )
    tasks.value = taskModules.tasks || Object.values(taskModules)

    // Update progress
    totalTasks.value = tasks.value.length
    currentTask.value = 1
  } catch (error) {
    console.error('Error loading tasks:', error)
    tasks.value = []
  }
})

const handleTaskResponse = (data: TaskResponse) => {
  // Only store task response for test modules
  if (isTestModule.value) {
    // Only play correct sound immediately
    if (data.isCorrectAnswer) {
      taskResponse.value = data
      correctSound.play()
    } else {
      // For wrong answers, only store the response without showing UI feedback
      taskResponse.value = { ...data, isCorrectAnswer: undefined }
    }
  } else {
    // For learn modules, directly move to next task
    handleTaskComplete()
  }
}

const handleTaskComplete = () => {
  // Guard clause: prevent proceeding without an answer
  if (isTestModule.value && !taskResponse.value) {
    return
  }

  // For test modules, handle wrong answers when clicking next
  if (isTestModule.value && taskResponse.value) {
    if (!taskResponse.value.canMoveNext) {
      // Now show the wrong indicator and play sound
      taskResponse.value = { ...taskResponse.value, isCorrectAnswer: false }
      wrongSound.play()
      return
    }
  }

  // Only play sounds for test modules
  if (isTestModule.value) {
    if (!taskResponse.value?.isCorrectAnswer) {
      wrongSound.play()
    }
  }

  // Check if we're at the last task
  if (visibleTasks.value == tasks.value.length) {
    endTime.value = Date.now()
    const timeSpent = Math.floor((endTime.value - startTime.value) / 1000) // Convert to seconds

    router.patch(
      route('modules.complete', {
        lesson: props.lesson.uri,
        module: props.module.uri,
      }),
      { time_spent: timeSpent },
    )
    return
  }

  // Different behavior based on module type
  if (taskResponse.value && isTestModule.value) {
    // For test modules: swap tasks
    visibleTasks.value = currentTask.value + 1
  } else {
    // For learn modules: append tasks
    visibleTasks.value++
  }
  currentTask.value++

  setTimeout(() => {
    const sections = document.querySelectorAll('#task-container')
    const lastSection = sections[sections.length - 1]
    lastSection?.scrollIntoView({ behavior: 'smooth' })
  }, 0)

  // Only reset task response for test modules
  if (isTestModule.value) {
    taskResponse.value = undefined
  }
}

// Function to mark the task as completed
const markTaskAsCompleted = (data: boolean) => {
  taskCompleted.value = data
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
          <!-- <span class="text-sm font-medium">
            {{ progressText }}
          </span> -->
        </div>
      </div>
    </MaxWidthWrapper>
  </div>
  <MaxWidthWrapper class="pt-16 md:max-w-[850px]">
    <main>
      <div v-if="tasks.length" class="space-y-4">
        <section
          id="task-container"
          v-for="(task, index) in isTestModule
            ? [tasks[currentTask - 1]].filter(Boolean)
            : tasks.slice(0, visibleTasks)"
          :key="index"
          class="flex min-h-[calc(100vh-80px)] flex-col justify-start py-12"
          v-auto-animate
        >
          <component :is="task" @response="handleTaskResponse" />
        </section>
      </div>
      <p v-else>No tasks found</p>
    </main>
    <div
      :class="
        cn(
          'fixed bottom-0 left-0 right-0 w-full border-t bg-card px-4 py-6',
          taskResponse?.isCorrectAnswer === true
            ? 'bg-green-100'
            : taskResponse?.isCorrectAnswer === false && 'bg-red-100',
        )
      "
    >
      <MaxWidthWrapper class="flex w-full items-center justify-between">
        <div class="text-2xl font-semibold">
          <div
            v-if="taskResponse?.isCorrectAnswer === true"
            class="flex items-center gap-3 text-green-700"
          >
            <CheckCircle2 class="size-10" />
            <p>Correct!</p>
          </div>
          <div
            v-else-if="taskResponse?.isCorrectAnswer === false"
            class="flex items-center gap-3 text-red-700"
          >
            <XCircle class="size-10" />
            <p>Wrong! Try again</p>
          </div>
          <p v-else>Question {{ currentTask }}</p>
        </div>
        <div>
          <Button
            variant="default"
            size="lg"
            @click="handleTaskComplete"
            enableSound
            :disabled="isTestModule && !taskResponse"
            :class="
              cn(
                taskResponse?.isCorrectAnswer === true
                  ? 'bg-green-500 text-white hover:bg-green-600'
                  : taskResponse?.isCorrectAnswer === false &&
                      'bg-red-500 text-white hover:bg-red-600',
              )
            "
          >
            {{ visibleTasks == tasks.length ? 'Finish' : 'Next' }}
            {{ props.module.category === 'learn' ? 'Task' : 'Question' }}
          </Button>
        </div>
      </MaxWidthWrapper>
    </div>
  </MaxWidthWrapper>
</template>
