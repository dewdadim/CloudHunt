<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import CourseCard from '../CourseCard.vue'
import { Card, CardContent, CardHeader, CardTitle } from '../ui/card'
import { ScrollArea, ScrollBar } from '../ui/scroll-area'
import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from '@/components/ui/collapsible'
import { HTMLAttributes, ref } from 'vue'
import { Button } from '../ui/button'
import { ChevronDown, ChevronsDown, ChevronUp } from 'lucide-vue-next'
import { cn } from '@/lib/utils'

defineProps<{
  class?: HTMLAttributes['class']
  courses: Course[]
}>()

const isOpen = ref(false)
</script>

<template>
  <!-- <Card :class="class">
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
  </Card> -->
  <Collapsible v-model:open="isOpen" class="space-y-4">
    <h3 class="mb-4 text-xl font-semibold">Continue Lesson</h3>
    <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
      <div v-for="course in courses.slice(0, 2)">
        <CourseCard
          :key="course.id"
          :title="course.title!"
          :uri="course.uri!"
          class="w-full"
        />
      </div>
    </div>
    <CollapsibleContent class="p-1" v-if="courses.slice(2).length > 0">
      <div class="grid w-full grid-cols-2 gap-3">
        <div v-for="course in courses.slice(2)">
          <CourseCard
            :key="course.id"
            :title="course.title!"
            :uri="course.uri!"
            class="w-full"
          />
        </div>
      </div>
    </CollapsibleContent>
    <CollapsibleTrigger as-child v-if="courses.slice(2).length > 0">
      <Button
        class="w-full gap-2 rounded-full border-0 bg-card/60 py-6 font-medium"
        variant="secondary"
      >
        Show {{ isOpen ? 'less' : 'more' }}
        <ChevronDown
          :class="
            cn('transition duration-300 ease-in-out', isOpen && '-rotate-180')
          "
        />
      </Button>
    </CollapsibleTrigger>
  </Collapsible>
</template>
