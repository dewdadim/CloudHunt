<script setup lang="ts">
import { AspectRatio } from '@/components/ui/aspect-ratio'
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'
import { Building, Mail, School } from 'lucide-vue-next'

const { user } = defineProps<{
  user: {
    username: string
    full_name: string
    prefer_name: string
    avatar: string
    date_of_birth: string
    email: string
    institute: string
    organisation: string
  }
}>()

const achievements = [
  {
    id: 1,
    badge_img: '../badges/cloudhunt_rank-1.svg',
    alt: 'CloudHunt Rank 1 Badge',
    count: 2,
  },
  {
    id: 2,
    badge_img: '../badges/cloudhunt_rank-2.svg',
    alt: 'CloudHunt Rank 2 Badge',
    count: 24,
  },
  {
    id: 3,
    badge_img: '../badges/cloudhunt_rank-3.svg',
    alt: 'CloudHunt Rank 3 Badge',
    count: 10,
  },
]
</script>

<template>
  <main class="mb-12 mt-4 grid gap-4 md:mt-8">
    <section class="flex w-full flex-wrap justify-between gap-4">
      <Card class="grow">
        <CardHeader class="flex flex-col md:flex-row md:justify-between">
          <div class="flex w-full flex-wrap items-center gap-4">
            <div class="w-48">
              <AspectRatio :ratio="1 / 1" class="rounded-xl bg-muted">
                <img
                  :src="user.avatar"
                  class="h-full w-full rounded-2xl border shadow-taper"
                />
              </AspectRatio>
            </div>
            <div class="flex max-w-2xl flex-col gap-2">
              <div class="flex flex-col">
                <CardTitle :title="user.full_name">{{
                  user.full_name
                }}</CardTitle>
                <CardDescription>
                  Preferably called as {{ user.prefer_name }}
                </CardDescription>
                <CardDescription>@{{ user.username }}</CardDescription>
              </div>
              <div class="flex flex-col gap-1">
                <CardDescription
                  class="flex items-center gap-1"
                  v-if="user.organisation"
                >
                  <Building :size="16" />{{ user.organisation }}
                </CardDescription>
                <CardDescription
                  class="flex items-center gap-1"
                  v-if="user.institute"
                >
                  <School :size="16" />{{ user.institute }}
                </CardDescription>
                <CardDescription
                  class="flex items-center gap-1"
                  v-if="user.email"
                >
                  <Mail :size="16" />{{ user.email }}
                </CardDescription>
              </div>
            </div>
          </div>
        </CardHeader>
      </Card>
      <!-- <div
        class="felx-none flex w-fit items-center justify-center gap-8 rounded-xl border bg-card px-16 py-8 shadow-taper sm:w-full md:w-fit"
      >
        <Separator orientation="vertical" />
        <div class="flex flex-col items-center">
          <p class="text-5xl font-semibold">3</p>
          <h3 class="text-center text-sm">Courses</h3>
        </div>
        <div class="flex flex-col items-center">
          <p class="text-5xl font-semibold">232</p>
          <h3 class="text-center text-sm">Profile Views</h3>
        </div>
      </div> -->
    </section>
    <Card>
      <CardHeader>
        <CardTitle>Badges & Achievements</CardTitle>
      </CardHeader>
      <CardContent>
        <div class="grid grid-cols-3 gap-1 md:grid-cols-5 lg:grid-cols-6">
          <div v-for="achievement in achievements" :key="achievement.id">
            <div class="relative w-auto">
              <p
                class="absolute right-4 top-4 z-10 flex size-8 rotate-12 items-center justify-center rounded-full border bg-primary p-1 text-xs font-semibold ring-2 ring-white"
                v-if="achievement.count > 1"
              >
                {{ achievement.count }}x
              </p>
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
