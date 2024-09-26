<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Progress } from '@/components/ui/progress'
import { Button } from '@/components/ui/button'
import { StarsIcon } from 'lucide-vue-next'
import Separator from '@/components/ui/separator/Separator.vue'
import { Link } from '@inertiajs/vue3'

import { ref } from 'vue'
import CourseCard from '@/components/CourseCard.vue'
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area'
import MiniCloudHuntChallenge from '@/components/dashboard/MiniCloudHuntChallenge.vue'
import News from '@/components/dashboard/News.vue'
import CourseSuggestion from '@/components/dashboard/CourseSuggestion.vue'
import ContinueLesson from '@/components/dashboard/ContinueLesson.vue'

const { auth, courses } = defineProps<{
  auth: {
    user: {
      username: string
      prefer_name: string
      avatar: string
    }
  }
  courses: Course[]
}>()

const xp = ref(70)
</script>

<template>
  <main
    class="mx-auto mb-12 mt-4 flex max-w-[400px] flex-col gap-4 overflow-x-visible md:mt-12 md:max-w-screen-lg md:flex-row lg:gap-8"
  >
    <div class="min-w-full md:min-w-[350px]">
      <Card class="sticky top-28 w-full md:w-[350px]">
        <CardHeader>
          <CardTitle>Welcome, {{ auth.user.prefer_name }} 👋</CardTitle>
          <CardDescription>@{{ auth.user.username }}</CardDescription>
          <Link :href="route('users.show', { id: auth.user.username })">
            <Button class="mt-4 w-full" variant="outline" size="lg">
              View Profile
            </Button>
          </Link>
        </CardHeader>
        <CardContent class="grid gap-6 pb-10">
          <Separator />
          <div class="flex flex-col gap-2">
            <h3 class="font-semibold">Your XP</h3>
            <p class="flex items-center gap-2 text-3xl font-semibold">
              <StarsIcon fill="#F9BF3B" class="text-primary" />
              {{ xp }}
            </p>
          </div>
          <div class="flex flex-col gap-2">
            <h3 class="font-semibold">Total courses</h3>
            <div class="flex justify-between">
              <p>2 completed</p>
              <p>5 enrolled</p>
            </div>
            <Progress :model-value="(2 / 5) * 100" class="h-2 bg-primary/30" />
          </div>
        </CardContent>
      </Card>
    </div>
    <div class="flex w-full flex-col gap-3">
      <ContinueLesson :courses="courses" />
      <News />
      <MiniCloudHuntChallenge />
      <CourseSuggestion :courses="courses" />
    </div>
  </main>
</template>
