<script setup lang="ts">
import { Timer } from 'lucide-vue-next'
import { Button } from '../ui/button'
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter,
} from '../ui/card'
import { Link } from '@inertiajs/vue3'
import { cn } from '@/lib/utils'

const ranks = [
  {
    id: 1,
    badge: '../badges/cloudhunt_rank-2.svg',
    champion_avatar: '../images/pfp.jpg',
    champion_user: 'nureeninsyirah888888',
    time: '00:05:21',
  },
  {
    id: 2,
    badge: '../badges/cloudhunt_rank-1.svg',
    champion_avatar: '../images/pfp.jpg',
    champion_user: 'nadimhairi',
    time: '00:04:23',
  },
  {
    id: 3,
    badge: '../badges/cloudhunt_rank-3.svg',
    champion_avatar: '../images/pfp.jpg',
    champion_user: 'anggun',
    time: '00:05:45',
  },
]
</script>

<template>
  <Card
    class="bg-gradient-to-tr from-slate-600 from-10% via-slate-500 via-30% to-slate-300 text-white"
  >
    <CardHeader class="justify-center text-center">
      <CardTitle class="font-pixel"> Mini CloudHunt Challenge </CardTitle>
      <CardDescription class="font-pixel text-inherit">
        Unleash your skills with weekly Mini CloudHunt Challenge!
      </CardDescription>
    </CardHeader>
    <CardContent class="flex flex-col items-center">
      <h4 class="text-lg font-semibold">Previous Champion</h4>
      <div class="flex h-full max-w-96 items-end gap-2 lg:gap-6">
        <div
          v-for="rank in ranks"
          class="h-fit bg-gradient-to-b from-slate-200/0 from-5% via-slate-200/20 to-slate-500/0 pt-2"
        >
          <div
            :class="
              cn(
                'flex min-w-20 flex-col items-center gap-1',
                rank.id === 1
                  ? 'mb-6'
                  : rank.id === 2
                    ? 'mb-12'
                    : rank.id === 3
                      ? 'mb-3'
                      : '',
              )
            "
          >
            <img :src="rank.badge" class="size-32" />
            <div
              class="flex flex-col items-center text-xs md:text-sm lg:text-base"
            >
              <img
                :src="rank.champion_avatar"
                class="w-1/3 rounded-lg border"
              />
              <div class="w-24 overflow-hidden text-center">
                <Link
                  :href="route('profile', { id: rank.champion_user })"
                  class="group"
                >
                  <p class="truncate text-sm group-hover:underline">
                    @{{ rank.champion_user }}
                  </p>
                </Link>
              </div>
              <p class="flex items-center gap-0.5 text-xs">
                <Timer :size="14" />{{ rank.time }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </CardContent>
    <CardFooter class="mt-8">
      <Button class="w-full" size="lg"> Begin Challenge! </Button>
    </CardFooter>
  </Card>
</template>
