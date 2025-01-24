<script setup lang="ts">
import { Card, CardContent } from './ui/card'
import { Progress } from './ui/progress'

const props = defineProps<{
  user: AuthUser
  lessons: Lesson[]
}>()

const completedLesson = props.lessons.filter(
  (lesson) => lesson.completed == true,
)
</script>
<template>
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
          <p>{{ completedLesson.length }} completed</p>
          <p>{{ props.lessons.length }} enrolled</p>
        </div>
        <Progress
          :model-value="(completedLesson.length / props.lessons.length) * 100"
          class="h-2 bg-primary/30"
        />
      </div>
    </CardContent>
  </Card>
</template>
