<script setup lang="ts">
import { Button } from '@/components/ui/button'
import XTerm from '@/components/XTerm.vue'
import { ref } from 'vue'

const emit = defineEmits<{
  (e: 'response', data: TaskResponse): void
}>()

const correct = ref(false)

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
      Now try to find "Hello.txt" and show the content in terminal.
    </p>
    <XTerm dissable-help-command @command-input="handleCommandInput" />
    <div v-if="correct">
      <h3>Correct!</h3>
    </div>
  </div>
</template>
