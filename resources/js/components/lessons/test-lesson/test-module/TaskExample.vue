<script setup lang="ts">
import XTerm from '@/components/XTerm.vue'

defineProps<{
  onComplete: () => void
}>()
</script>

<template>
  <div class="space-y-6">
    <p>Try to list all files and directories using terminal.</p>
    <XTerm />
  </div>
</template>
