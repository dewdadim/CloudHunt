<script setup lang="ts">
import ProfileCard from '@/components/profile/ProfileCard.vue'
import { Card, CardHeader } from '@/components/ui/card'

const { user } = defineProps<{
  user: User
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
  <main
    class="mx-auto mb-12 mt-4 flex max-w-[400px] flex-col gap-8 overflow-x-visible md:mt-12 md:max-w-screen-lg md:flex-row lg:gap-8"
  >
    <div class="min-w-full md:min-w-[350px]">
      <div class="sticky top-28 w-full md:w-[350px]">
        <ProfileCard :user="user" />
      </div>
    </div>
    <div class="flex w-full flex-col gap-8">
      <Card class="h-64 w-full">
        <CardHeader></CardHeader>
      </Card>
      <Card class="h-64 w-full">
        <CardHeader></CardHeader>
      </Card>
      <Card class="h-64 w-full">
        <CardHeader></CardHeader>
      </Card>
    </div>
  </main>
</template>
