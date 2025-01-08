<script setup lang="ts">
import { Card, CardContent, CardFooter } from '@/components/ui/card'
import { Progress } from '@/components/ui/progress'
import { Button } from '@/components/ui/button'
import { StarsIcon } from 'lucide-vue-next'
import { Link, usePage } from '@inertiajs/vue3'
import MiniCloudHuntChallenge from '@/components/dashboard/MiniCloudHuntChallenge.vue'
import News from '@/components/dashboard/News.vue'
import CourseSuggestion from '@/components/dashboard/CourseSuggestion.vue'
import ContinueLesson from '@/components/dashboard/ContinueLesson.vue'

import { ref } from 'vue'
import LessonCard from '@/components/LessonCard.vue'
import JumpBackIn from '@/components/dashboard/JumpBackIn.vue'

const props = defineProps<{
  lessons: Lesson[]
}>()

const user = usePage().props.auth.user

const xp = ref(70)
</script>

<template>
  <main
    class="mx-auto mb-12 mt-4 flex max-w-[400px] flex-col gap-8 overflow-x-visible md:mt-12 md:max-w-screen-lg md:flex-row lg:gap-8"
  >
    <div class="min-w-full md:min-w-[350px]">
      <div class="sticky top-28 w-full md:w-[350px]">
        <h2 class="mb-4 text-xl font-semibold">
          Welcome, {{ user.prefer_name }} 👋
        </h2>

        <Card class="w-full">
          <CardContent class="grid gap-6 pb-10 pt-4">
            <div class="flex flex-col gap-2">
              <h3 class="font-semibold">Your XP</h3>
              <p class="flex items-center gap-2 text-3xl font-semibold">
                <StarsIcon fill="#F9BF3B" class="text-primary" />
                {{ user.xp }}
              </p>
            </div>
            <div class="flex flex-col gap-2">
              <h3 class="font-semibold">Total courses</h3>
              <div class="flex justify-between">
                <p>2 completed</p>
                <p>5 enrolled</p>
              </div>
              <Progress
                :model-value="(2 / 5) * 100"
                class="h-2 bg-primary/30"
              />
            </div>
          </CardContent>
          <CardFooter>
            <Link
              class="w-full"
              :href="route('users.show', { id: user.username })"
            >
              <Button class="mt-4 w-full" variant="outline" size="lg">
                View Profile
              </Button>
            </Link>
          </CardFooter>
        </Card>
      </div>
    </div>
    <div class="flex w-full flex-col gap-8">
      <!-- <News class="mb-2 mt-0" /> -->

      <!-- <LessonCard
        :title="courses[0].title"
        :uri="courses[0].uri"
        class="w-full shadow-taper"
      /> -->
      <JumpBackIn :lesson="props.lessons[0]" v-if="props.lessons.length" />
      <!-- <div class="space-y-4">
        <h3 class="text-xl font-semibold">Jump back in!</h3>
        <LessonCard :lesson="lessons[0]" class="w-full" />
      </div> -->
      <MiniCloudHuntChallenge />
      <ContinueLesson :lessons="props.lessons" v-if="props.lessons.length" />
      <!-- <CourseSuggestion :lessons="lessons" /> -->
    </div>
  </main>
</template>
