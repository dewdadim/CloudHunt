<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { Primitive, type PrimitiveProps } from 'radix-vue'
import { type ButtonVariants, buttonVariants } from '.'
import { cn } from '@/lib/utils'

interface Props extends PrimitiveProps {
  variant?: ButtonVariants['variant']
  size?: ButtonVariants['size']
  class?: HTMLAttributes['class']
  soundEffect?: string
  enableSound?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  as: 'button',
  soundEffect: '/sounds/click.mp3',
  enableSound: false,
})

const playSound = () => {
  if (!props.enableSound) return
  const audio = new Audio(props.soundEffect)
  audio.volume = 0.5
  audio.play().catch((error) => {
    console.warn('Sound effect could not be played:', error)
  })
}
</script>

<template>
  <Primitive
    :as="as"
    :as-child="asChild"
    :class="cn(buttonVariants({ variant, size }), props.class)"
    @click="playSound"
  >
    <slot />
  </Primitive>
</template>
