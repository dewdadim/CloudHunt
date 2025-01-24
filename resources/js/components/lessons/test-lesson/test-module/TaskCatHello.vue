<script setup lang="ts">
import { Button } from '@/components/ui/button'
import XTerm from '@/components/XTerm.vue'
import { ref } from 'vue'

const emit = defineEmits<{
  (e: 'response', data: TaskResponse): void
}>()

const handleCommandInput = (path: string, command: string) => {
  if (path === '/home/user/documents' && command === 'cat hello.txt') {
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
      Now try to find
      <code class="rounded-lg bg-card/60 p-2 text-base font-normal"
        >Hello.txt</code
      >
      and show the content in terminal
    </p>
    <XTerm dissable-help-command @command-input="handleCommandInput" />
  </div>
</template>
