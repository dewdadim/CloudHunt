<script setup lang="ts">
import { Button } from '@/components/ui/button'

defineProps<{
  onComplete: () => void
}>()
</script>

<template>
  <div class="space-y-6">
    <div class="space-y-3">
      <h3 class="text-xl font-semibold">Cloud? Computer in the sky?</h3>
      <p>
        Cloud computing is the delivery of computing services over the internet.
        It allows users to access computing resources, such as storage,
        databases, and software, on-demand, and pay only for what they use.
      </p>
      <h4 class="pt-4 text-lg font-medium">Basically...</h4>
      <p>
        Cloud is an internet. Therefore, cloud computing is computing services
        over the internet!
      </p>
    </div>
  </div>
</template>
