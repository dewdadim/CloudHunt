<script setup lang="ts">
import XTerm from '@/components/XTerm.vue'
import { ref } from 'vue'

const emit = defineEmits<{
  (e: 'response', data: TaskResponse): void
}>()

const handleCommandInput = (path: string, command: string) => {
  if (path === '/home/user/projects/web' && command === 'mkdir assets') {
    return emit('response', {
      canMoveNext: true,
      isCorrectAnswer: true,
    })
  }

  return emit('response', {
    canMoveNext: false,
    isCorrectAnswer: false,
  })
}
</script>
<template>
  <div class="space-y-10">
    <p class="text-xl font-semibold">
      Find
      <code class="rounded-lg bg-card/60 p-2 text-base font-normal"
        >/projects/web/</code
      >
      directory. Then create
      <code class="rounded-lg bg-card/60 p-2 text-base font-normal"
        >assets</code
      >
      folder in the
      <code class="rounded-lg bg-card/60 p-2 text-base font-normal"
        >/projects/web/</code
      >
      directory
    </p>
    <XTerm dissable-help-command @command-input="handleCommandInput" />
  </div>
</template>
