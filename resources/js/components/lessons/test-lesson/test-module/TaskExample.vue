<script setup lang="ts">
import XTerm from '@/components/XTerm.vue'

defineProps<{
  onComplete: () => void
}>()
</script>

<template>
  <div class="space-y-10">
    <p class="text-xl font-semibold">
      Try to list all files and directories using terminal.
    </p>
    <XTerm dissable-help-command />
  </div>
</template>
