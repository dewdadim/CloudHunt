<script setup lang="ts">
const emit = defineEmits<{
  (e: 'response', data: TaskResponse): void
}>()

emit('response', {
  canMoveNext: true,
})
</script>
<template><h1>Test</h1></template>
