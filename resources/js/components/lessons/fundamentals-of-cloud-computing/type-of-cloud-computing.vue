<script setup lang="ts">
import ModuleFinishButton from '@/components/ModuleFinishButton.vue'

const props = defineProps<{
  lesson: Lesson
  module: Module
}>()
</script>

<template>
  <div class="flex flex-col justify-center gap-4 text-center">
    <h3 class="text-6xl">🛠</h3>
    <h2 class="text-xl font-bold">
      "Type of Cloud Computing" Module Generated
    </h2>
    <p>
      This vue file is auto generated, you can edit it at <br />
      /Users/nadimhairi/Documents/RunCloudEducation/app/../resources/js/components/lessons/fundamentals-of-cloud-computing/type-of-cloud-computing.vue
    </p>
    <p>
      <span class="font-bold">Lesson: </span>Fundamentals of Cloud Computing
    </p>
    <p><span class="font-bold">Module: </span>Type of Cloud Computing</p>
    <ModuleFinishButton :lesson="props.lesson" :module="props.module" />
  </div>
</template>
