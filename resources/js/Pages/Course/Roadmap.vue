<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import Navbar from './Navbar.vue'
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'

const { course } = defineProps<{
  course: {
    title: string
    id: number
  }
  chapters: {
    title: string
    id: number
  }
}>()
</script>

<template>
  <Navbar :course="course" />
  <MaxWidthWrapper class="md:max-w-screen-xl">
    <div class="flex w-full items-center justify-center">
      <Card class="shadow-0 mt-20 w-full gap-4 border-none bg-white/0 md:w-5/6">
        <CardHeader class="text-center">
          <CardDescription>Chapter 1</CardDescription>
          <CardTitle>Introduction to Cloud Computing</CardTitle>
        </CardHeader>
        <CardContent
          class="relative flex h-[580px] justify-between md:px-24 md:py-12"
        >
          <div class="relative h-full w-full">
            <Card class="absolute top-0 h-52 w-48">
              <CardContent></CardContent>
            </Card>
          </div>
          <div class="relative h-full w-full">
            <Card class="absolute bottom-0 h-52 w-48">
              <CardContent></CardContent>
            </Card>
          </div>
          <div class="relative h-full w-full">
            <Card class="absolute top-0 h-52 w-48">
              <CardContent></CardContent>
            </Card>
          </div>
          <div class="relative h-full w-full">
            <Card class="absolute bottom-0 h-52 w-48">
              <CardContent></CardContent>
            </Card>
          </div>
        </CardContent>
      </Card>
    </div>
  </MaxWidthWrapper>
</template>
