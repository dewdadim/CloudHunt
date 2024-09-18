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
      <Card class="shadow-0 mt-20 w-full gap-4 md:w-5/6">
        <CardHeader class="text-center">
          <CardDescription>Chapter 1</CardDescription>
          <CardTitle>Introduction to Cloud Computing</CardTitle>
        </CardHeader>
        <CardContent class="h-[500px]"> </CardContent>
      </Card>
    </div>
  </MaxWidthWrapper>
</template>
