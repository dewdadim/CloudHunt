<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import LessonCard from '../LessonCard.vue'
import {
  Card,
  CardContent,
  CardFooter,
  CardHeader,
  CardTitle,
} from '../ui/card'
import { ScrollArea, ScrollBar } from '../ui/scroll-area'
import { ArrowRight } from 'lucide-vue-next'
import { Button } from '../ui/button'

defineProps<{
  class?: string
  lessons: Lesson[]
}>()
</script>

<template>
  <Card :class="class">
    <CardHeader>
      <CardTitle>Courses For You</CardTitle>
    </CardHeader>
    <CardContent>
      <div class="flex">
        <ScrollArea class="w-1 flex-1" :scroll-hide-delay="100">
          <div class="flex w-max space-x-4">
            <div v-for="lesson in lessons">
              <LessonCard
                :lesson="lesson"
                class="w-60"
                :key="lesson.id"
                :title="lesson.title!"
                :uri="lesson.uri!"
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
    <CardFooter class="justify-end">
      <Link :href="route('lessons')" class="group">
        <Button variant="link" class="font-medium">
          Explore more courses
          <ArrowRight
            :size="16"
            class="ml-1 transition group-hover:translate-x-1"
          />
        </Button>
      </Link>
    </CardFooter>
  </Card>
</template>
