<script setup lang="ts">
import ConfettiExplosion from 'vue-confetti-explosion'
import { Button } from '../ui/button'
</script>

<template>
  <div class="flex flex-col items-center gap-2 text-center">
    <ConfettiExplosion :particleCount="200" :force="0.3" />
    <p class="mb-6 pl-8 text-9xl">🎉</p>
    <p>
      The bright future has been set for you! Start learning with RunCloud Edu.
    </p>
  </div>
</template>
