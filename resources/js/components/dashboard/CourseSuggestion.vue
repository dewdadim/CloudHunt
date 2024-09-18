<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import CourseCard from '../CourseCard.vue'
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
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle>Courses For You</CardTitle>
    </CardHeader>
    <CardContent>
      <div class="flex">
        <ScrollArea className="w-1 flex-1" :scroll-hide-delay="100">
          <div class="flex w-max space-x-4">
            <div v-for="i in 6">
              <CourseCard class="w-60" uri="fundamental-of-cloud-computing" />
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
      <Link href="#" class="group">
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
