<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import ModuleFinishButton from '@/components/ModuleFinishButton.vue'
import { Button } from '@/components/ui/button'
import { Link } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'

const props = defineProps<{
  lesson: Lesson
  module: Module
}>()

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
  <MaxWidthWrapper class="md:max-w-screen-md">
    <section class="space-y-6 py-20">
      <div class="space-y-3">
        <h3 class="text-xl font-semibold">Cloud? Computer in the sky?</h3>
        <p>
          Cloud computing is the delivery of computing services over the
          internet. It allows users to access computing resources, such as
          storage, databases, and software, on-demand, and pay only for what
          they use.
        </p>
        <h4 class="pt-4 text-lg font-medium">Basically...</h4>
        <p>
          Cloud is an internet. Therefore, cloud computing is computing services
          over the internet!
        </p>
      </div>
      <Button @click="nextTask" variant="secondary" size="lg">
        Now I understand!
      </Button>
    </section>
    <!-- <section>
      <ModuleFinishButton :lesson="props.lesson" :module="props.module" />
    </section> -->
  </MaxWidthWrapper>
</template>
