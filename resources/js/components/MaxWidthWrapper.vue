<script setup lang="ts">
import { cn } from '@/lib/utils'
import type { HTMLAttributes } from 'vue'

const props = defineProps<{
  class?: HTMLAttributes['class']
}>()
</script>

<template>
  <div
    :class="cn('mx-auto w-full px-4 md:max-w-screen-lg md:px-6', props.class)"
  >
    <slot />
  </div>
</template>
