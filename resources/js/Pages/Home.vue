<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { reactive } from 'vue'
import Navbar from '@/components/Navbar.vue'

const add = (x: number, y: number) => {
  return x + y
}

const data = reactive({
  a: 0,
})
</script>

<template>
  <Navbar />
  <div class="flex h-screen">
    <aside class="h-full w-80 flex-none border-r"></aside>
    <MaxWidthWrapper class="h-full flex-initial">
      <div class="h-full w-full bg-purple-50"></div>
    </MaxWidthWrapper>
  </div>
</template>
