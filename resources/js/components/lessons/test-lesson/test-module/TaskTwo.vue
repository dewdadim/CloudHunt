<script setup lang="ts">
import XTerm from '@/components/XTerm.vue'
</script>
<template>
  <div class="space-y-10">
    <p class="text-xl font-semibold">
      Now try to find "Hello.txt" and show the content in terminal.
    </p>
    <XTerm dissable-help-command />
  </div>
</template>
