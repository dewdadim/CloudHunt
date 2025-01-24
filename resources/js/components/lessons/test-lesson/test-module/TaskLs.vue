<script setup lang="ts">
import { Button } from '@/components/ui/button'
import XTerm from '@/components/XTerm.vue'
import { ref, toRefs } from 'vue'

const emit = defineEmits<{
  (e: 'response', data: TaskResponse): void
}>()

const isDisabled = ref(false)

const handleCommandInput = (path: string, command: string) => {
  if (path && command === 'ls') {
    isDisabled.value = true
    emit('response', {
      canMoveNext: true,
      isCorrectAnswer: true,
    })
    return
  }
  emit('response', {
    canMoveNext: false,
    isCorrectAnswer: false,
  })
  return
}
</script>

<template>
  <div class="space-y-10">
    <p class="text-xl font-semibold">
      Try to list all files and directories using terminal.
    </p>
    <XTerm
      :disabled="isDisabled"
      dissable-help-command
      @command-input="handleCommandInput"
    />
  </div>
</template>
