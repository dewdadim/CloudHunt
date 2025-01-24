<script setup lang="ts">
import XTerm from '@/components/XTerm.vue'
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const emit = defineEmits<{
  (e: 'response', data: TaskResponse): void
}>()

const user = usePage().props.auth.user

const handleCommandInput = (path: string, command: string) => {
  if (path && command === `echo ${user.prefer_name}`) {
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
      Print your account prefered name in the Terminal
    </p>
    <XTerm dissable-help-command @command-input="handleCommandInput" />
  </div>
</template>
