<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { onMounted, ref } from 'vue'

const emit = defineEmits(['total-tasks', 'current-task'])

const tasks = [1, 2, 3, 4, 5, 2, 2]

const currentTask = ref(0)

onMounted(() => {
  emit('total-tasks', tasks.length)
})
const nextTask = async () => {
  if (currentTask.value < tasks.length - 1) {
    currentTask.value++
    console.log(currentTask.value)
    emit('current-task', currentTask.value)
  }
}
</script>

<template>
  <section class="my-16 flex flex-col items-center gap-2">
    <div class="flex flex-col justify-center gap-4 text-center">
      <h3 class="text-6xl">🛠</h3>
      <h2 class="text-xl font-bold">"What is Cloud?" Module Generated</h2>
      <p class="break-all">
        This vue file is auto generated, you can edit it at <br />
        /Users/nadimhairi/Documents/RunCloudEducation/app/../resources/js/components/lessons/fundamentals-of-cloud-computing/what-is-cloud.vue
      </p>
      <p>
        <span class="font-bold">Lesson: </span>Fundamentals of Cloud Computing
      </p>
      <p><span class="font-bold">Module: </span>What is Cloud?</p>
    </div>
    <Button @click="nextTask">Test</Button>
  </section>
</template>
