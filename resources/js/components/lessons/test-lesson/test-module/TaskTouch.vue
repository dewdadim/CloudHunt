<script setup lang="ts">
import XTerm from '@/components/XTerm.vue'
import { ref } from 'vue'

const emit = defineEmits<{
  (e: 'response', data: TaskResponse): void
}>()

const handleCommandInput = (path: string, command: string) => {
  if (path === '/home/user/documents/notes' && command === 'touch 2025.txt') {
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
      <code class="rounded-lg bg-card/60 p-2 text-base font-normal">notes</code>
      directory and create
      <code class="rounded-lg bg-card/60 p-2 text-base font-normal"
        >2025.txt</code
      >
      file in the directory
    </p>
    <XTerm dissable-help-command @command-input="handleCommandInput" />
  </div>
</template>
