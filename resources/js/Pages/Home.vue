<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { reactive } from 'vue'
import Navbar from '@/components/Navbar.vue'
import { Card, CardHeader, CardTitle } from '@/components/ui/card'

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
    <MaxWidthWrapper
      class="mt-28 max-w-[450px] md:max-w-screen-sm md:px-36 lg:max-w-screen-xl"
    >
      <!-- <MaxWidthWrapper> -->
      <div class="flex flex-col justify-center gap-8 lg:flex-row">
        <div class="relative w-full lg:w-[400px]">
          <div class="static w-full lg:fixed lg:w-[400px]">
            <h2 class="text-xl font-bold">Welcome, Nadim</h2>
            <Card class="mt-6 w-full shadow-none">
              <CardHeader>
                <CardTitle>Jump back!</CardTitle>
              </CardHeader>
            </Card>
          </div>
        </div>
        <div class="flex grow flex-col gap-2">
          <h2 class="text-xl font-bold">Welcome, Nadim</h2>
          <Card class="mt-4 h-[400px]">
            <CardHeader>
              <CardTitle>Section 1</CardTitle>
            </CardHeader>
          </Card>
          <Card class="h-[300px]">
            <CardHeader>
              <CardTitle>Section 2</CardTitle>
            </CardHeader>
          </Card>
        </div>
      </div>
      <!-- </MaxWidthWrapper> -->
    </MaxWidthWrapper>
  </div>
</template>
