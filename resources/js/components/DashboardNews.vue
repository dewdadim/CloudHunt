<script setup lang="ts">
import { ArrowRight } from 'lucide-vue-next'
import { Button } from './ui/button'
import { cn } from '@/lib/utils'

const props = defineProps<{
  class?: string
}>()
</script>

<template>
  <div
    :class="
      cn(
        'my-4 flex h-16 w-full items-center justify-between gap-4 rounded-2xl border bg-gradient-to-r from-cyan-500 via-amber-400 to-pink-500 p-8 text-white shadow-taper',
        props.class,
      )
    "
  >
    <p class="font-semibold text-black">
      Some News that might be interesting...
    </p>
    <Button
      class="group gap-1 rounded-full border-none bg-black text-white hover:bg-black"
      size="sm"
      variant="secondary"
    >
      Button
      <ArrowRight
        :size="16"
        class="transition ease-in-out group-hover:translate-x-1"
      />
    </Button>
  </div>
</template>
