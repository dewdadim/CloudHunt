<script setup lang="ts">
import ConfettiExplosion from 'vue-confetti-explosion'
</script>

<template>
  <div class="flex flex-col items-center gap-2 text-center">
    <ConfettiExplosion
      class="animate-disappear"
      :stageWidth="300"
      :stageHeight="650"
      :particleCount="70"
      :particleSize="6"
      :duration="3000"
    />
    <p class="motion-preset-shake motion-duration-2000 z-20 mb-6 pl-8 text-9xl">
      🎉
    </p>
    <p>
      The bright future has been set for you! Start learning with RunCloud Edu.
    </p>
  </div>
</template>
