<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import FullNameQuestion from '@/components/onboard/FullNameQuestion.vue'
import { Progress } from '@/components/ui/progress'
import { ChevronLeft } from 'lucide-vue-next'

import { ref, watchEffect } from 'vue'

const progress = ref(0)

watchEffect((cleanupFn) => {
  const timer = setTimeout(() => (progress.value = 25), 500)
  cleanupFn(() => clearTimeout(timer))
})
</script>

<template>
  <MaxWidthWrapper class="h-screen pt-10">
    <div class="mb-16 flex items-center gap-4">
      <ChevronLeft class="flex-none" :size="28" v-on:click="" />
      <Progress v-model="progress" class="w-6 grow" />
    </div>
    <main class="flex flex-col items-center">
      <FullNameQuestion />
    </main>
  </MaxWidthWrapper>
</template>
