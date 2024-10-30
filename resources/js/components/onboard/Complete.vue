<script setup lang="ts">
import ConfettiExplosion from 'vue-confetti-explosion'
</script>

<template>
  <div class="flex flex-col items-center gap-2 overflow-visible text-center">
    <ConfettiExplosion
      class="animate-disappear"
      :stageWidth="800"
      :duration="3000"
    />
    <p class="mb-6 pl-8 text-9xl">🎉</p>
    <p>
      The bright future has been set for you! Start learning with RunCloud Edu.
    </p>
  </div>
</template>
