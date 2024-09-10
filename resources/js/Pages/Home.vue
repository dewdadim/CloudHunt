<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Progress } from '@/components/ui/progress'
import { Button } from '@/components/ui/button'
import { StarsIcon } from 'lucide-vue-next'
import Separator from '@/components/ui/separator/Separator.vue'
import { Link } from '@inertiajs/vue3'

import { ref } from 'vue'

const { auth } = defineProps<{
  auth: {
    user: {
      username: string
      prefer_name: string
      avatar: string
    }
  }
}>()

const xp = ref(70)
</script>

<template>
  <div
    class="mx-auto mt-4 flex max-w-[400px] flex-col gap-4 overflow-x-visible md:mt-12 md:max-w-screen-lg md:flex-row lg:gap-8"
  >
    <div class="min-w-full md:min-w-[350px]">
      <Card class="sticky top-28 w-full md:w-[350px]">
        <CardHeader>
          <CardTitle>Welcome, {{ auth.user.prefer_name }} 👋</CardTitle>
          <CardDescription>@{{ auth.user.username }}</CardDescription>
          <Link :href="route('profile', [{ id: auth.user.username }])"
            ><Button class="mt-4 w-full" variant="outline">
              View Profile
            </Button></Link
          >
        </CardHeader>
        <CardContent class="grid gap-6 pb-10">
          <Separator />
          <div class="flex flex-col gap-2">
            <h3 class="font-semibold">Your XP</h3>
            <p class="flex items-center gap-2 text-3xl font-semibold">
              <StarsIcon fill="#F9BF3B" class="text-primary" />
              2324
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
      <div
        class="flex h-16 w-full items-center rounded-xl border bg-pink-300 p-8"
      >
        Some News...
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Continue Course</CardTitle>
        </CardHeader>
        <CardContent>
          <div class="mt-4 flex gap-4 overflow-auto">
            <div class="w-full border p-2">
              <div class="mb-2 h-40 w-full max-w-40 bg-teal-500" />
              <h3 class="font-medium">Cybersecurity</h3>
            </div>
            <div class="w-full border p-2">
              <div class="mb-2 size-full max-w-40 bg-teal-500" />
              <h3 class="font-medium">Cybersecurity</h3>
            </div>
          </div>
        </CardContent>
      </Card>
      <Card class="h-96"><CardHeader></CardHeader></Card>
      <Card class="h-56"><CardHeader></CardHeader></Card>
      <Card class=""><CardHeader></CardHeader></Card>
    </div>
  </div>
</template>
