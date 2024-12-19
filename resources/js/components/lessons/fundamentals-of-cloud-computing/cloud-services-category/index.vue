<script setup lang="ts">
import ModuleFinishButton from '@/components/ModuleFinishButton.vue'
import { onMounted, ref } from 'vue'

// Import task component here
import TaskExample from './TaskExample.vue'

// Add imported tasks here
const tasks = [TaskExample]

const props = defineProps<{
  lesson: Lesson
  module: Module
}>()

const emit = defineEmits<{
  (event: 'update-progress', current: number, total: number): void
}>()

onMounted(() => {
  emit('update-progress', 1, tasks.length)
})

const currentTaskIndex = ref(0)
const visibleSections = ref(1)

const handleTaskComplete = () => {
  if (visibleSections.value < tasks.length) {
    visibleSections.value++
    currentTaskIndex.value++
    emit('update-progress', currentTaskIndex.value + 1, tasks.length)

    setTimeout(() => {
      const sections = document.querySelectorAll('#task-container')
      const lastSection = sections[sections.length - 1]
      lastSection?.scrollIntoView({ behavior: 'smooth' })
    }, 0)
  }
}
</script>

<template>
  <div class="space-y-10">
    <section
      id="task-container"
      v-for="(task, index) in tasks.slice(0, visibleSections)"
      :key="index"
      class="flex min-h-[calc(100vh-80px)] flex-col justify-start py-20"
    >
      <component :is="task" :onComplete="handleTaskComplete" />
      <div class="mt-6">
        <ModuleFinishButton
          v-if="index === visibleSections - 1 && index === tasks.length - 1"
          :lesson="props.lesson"
          :module="props.module"
        />
      </div>
    </section>
  </div>
</template>
