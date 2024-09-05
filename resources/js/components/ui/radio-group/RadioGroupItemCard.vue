<script setup lang="ts">
import { cn } from '@/lib/utils'
import RadioGroupItem from './RadioGroupItem.vue'
import { type HTMLAttributes } from 'vue'

const props = defineProps<{
  id: string
  class?: HTMLAttributes['class']
}>()
</script>

<template>
  <Label
    :for="props.id"
    :class="
      cn(
        'flex cursor-pointer gap-4 rounded-xl border px-6 py-4 shadow-taper transition-colors [&:has(:checked)]:border-primary [&:has(:checked)]:bg-primary/10',
        props.class,
      )
    "
  >
    <RadioGroupItem :id="props.id" :value="props.id" class="peer sr-only" />
    <slot>
      <div class="space-y-1">
        <h4 class="font-semibold">Radio Button Title</h4>
        <p class="text-sm text-muted-foreground">Radio Button Description</p>
      </div>
    </slot>
  </Label>
</template>
