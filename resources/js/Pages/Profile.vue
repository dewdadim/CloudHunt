<script setup lang="ts">
import { AspectRatio } from '@/components/ui/aspect-ratio'
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'

const { user } = defineProps<{
  user: {
    username: string
    full_name: string
    avatar: string
    date_of_birth: string
  }
}>()

const achievements = [
  {
    id: 1,
    badge_img: '../badges/cloudhunt_rank-1.svg',
    alt: 'CloudHunt Rank 1 Badge',
  },
  {
    id: 2,
    badge_img: '../badges/cloudhunt_rank-2.svg',
    alt: 'CloudHunt Rank 2 Badge',
  },
  {
    id: 3,
    badge_img: '../badges/cloudhunt_rank-3.svg',
    alt: 'CloudHunt Rank 3 Badge',
  },
]
</script>

<template>
  <main class="mb-12 mt-4 grid gap-4">
    <Card class="md:mt-12">
      <CardHeader class="flex flex-row justify-between">
        <div class="flex items-center gap-2">
          <div class="w-40">
            <AspectRatio :ratio="1 / 1" class="rounded-xl bg-muted">
              <img
                :src="user.avatar"
                class="h-full w-full rounded-2xl border shadow-taper"
              />
            </AspectRatio>
          </div>
          <div class="flex flex-col">
            <CardTitle>{{ user.full_name }}</CardTitle>
            <CardDescription>@{{ user.username }}</CardDescription>
          </div>
        </div>
      </CardHeader>
    </Card>
    <Card>
      <CardHeader>
        <CardTitle>Badges & Achievements</CardTitle>
      </CardHeader>
      <CardContent>
        <div class="grid grid-cols-3 gap-1 md:grid-cols-5 lg:grid-cols-6">
          <div v-for="achievement in achievements" :key="achievement.id">
            <div class="w-auto">
              <AspectRatio
                :ratio="1 / 1"
                class="rounded-xl p-2 hover:bg-accent md:p-4"
              >
                <img
                  :src="achievement.badge_img"
                  :alt="achievement.alt"
                  class="h-full w-full"
                />
              </AspectRatio>
            </div>
          </div>
        </div>
      </CardContent>
    </Card>
    <Card>
      <CardHeader>
        <CardTitle>Certifications</CardTitle>
      </CardHeader>
      <CardContent>
        <div class="grid grid-cols-3 gap-1 md:grid-cols-5 lg:grid-cols-6">
          <div
            v-for="achievement in achievements"
            :key="achievement.id"
            class="w-auto"
          >
            <AspectRatio
              :ratio="1 / 1"
              class="rounded-xl p-2 hover:bg-accent md:p-4"
            >
              <img
                :src="achievement.badge_img"
                :alt="achievement.alt"
                class="h-full w-full"
              />
            </AspectRatio>
          </div>
        </div>
      </CardContent>
    </Card>
  </main>
</template>
