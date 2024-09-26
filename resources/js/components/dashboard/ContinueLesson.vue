<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import CourseCard from '../CourseCard.vue'
import { Card, CardContent, CardHeader, CardTitle } from '../ui/card'
import { ScrollArea, ScrollBar } from '../ui/scroll-area'

defineProps<{
  class?: string
  courses: Course[]
}>()
</script>

<template>
  <Card :class="class">
    <CardHeader>
      <CardTitle>Continue Lesson</CardTitle>
    </CardHeader>
    <CardContent>
      <div class="flex">
        <ScrollArea className="w-1 flex-1" :scroll-hide-delay="100">
          <div class="flex w-max space-x-4">
            <div v-for="course in courses">
              <CourseCard
                :key="course.id"
                :title="course.title!"
                :uri="course.uri!"
              />
            </div>
          </div>
          <ScrollBar
            orientation="horizontal"
            class="transition-opacity ease-in-out"
          />
        </ScrollArea>
      </div>
    </CardContent>
  </Card>
</template>
