<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import CourseCard from './CourseCard.vue'
import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from '@/components/ui/collapsible'
import { HTMLAttributes, ref } from 'vue'
import { Button } from './ui/button'
import { ChevronDown, ChevronsDown, ChevronUp } from 'lucide-vue-next'
import { cn } from '@/lib/utils'

const { title, courses, gridCols } = defineProps<{
  title: string
  gridCols: number
  courses: Course[]
}>()

const isOpen = ref(false)
console.log(courses)
</script>

<template>
  <Collapsible v-model:open="isOpen" class="space-y-4">
    <h3 class="mb-4 text-xl font-semibold">{{ title }}</h3>
    <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3">
      <div v-for="course in courses.slice(0, 3)">
        <CourseCard
          :key="course.id"
          :title="course.title!"
          :uri="course.uri!"
          class="w-full"
        />
      </div>
    </div>
    <CollapsibleContent class="p-1" v-if="courses.slice(2).length > 0">
      <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3">
        <div v-for="course in courses.slice(3)">
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
