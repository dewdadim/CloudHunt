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

const ranks = [
  {
    badge: '../badges/cloudhunt_rank-2.svg',
    champion_user: 'nureeninsyirah',
    time: '00:05:21',
  },
  {
    badge: '../badges/cloudhunt_rank-1.svg',
    champion_user: 'nadimhairi',
    time: '00:04:23',
  },
  {
    badge: '../badges/cloudhunt_rank-3.svg',
    champion_user: 'anggun',
    time: '00:05:45',
  },
]
</script>

<template>
  <Card class="bg-gradient-to-tr from-slate-600 to-slate-400 text-white">
    <CardHeader class="justify-center text-center">
      <CardTitle class="font-pixel"> Mini CloudHunt Challenge </CardTitle>
      <CardDescription class="font-pixel text-inherit">
        Unleash your skills with weekly Mini CloudHunt Challenge!
      </CardDescription>
    </CardHeader>
    <CardContent class="mt-4 flex flex-col items-center gap-4">
      <h4 class="text-lg font-semibold">Previous Champion</h4>
      <div class="flex max-w-96 gap-2 md:gap-4">
        <div v-for="rank in ranks">
          <div class="flex min-w-20 flex-col items-center gap-2">
            <img :src="rank.badge" class="z-10 size-full" />
            <div
              class="flex flex-col items-center gap-1 text-xs md:text-sm lg:text-base"
            >
              <div class="max-w-20 overflow-hidden md:max-w-full">
                <p class="animate-to-left lg:animate-none">
                  @{{ rank.champion_user }}
                </p>
              </div>
              <p>{{ rank.time }}</p>
            </div>

            <!-- <div
              class="absolute top-8 h-52 w-[100%-20] bg-gradient-to-b from-white/20 to-white/0 md:w-28"
            /> -->
          </div>
        </div>
      </div>
    </CardContent>
    <CardFooter class="mt-8">
      <Button class="w-full" size="lg"> Begin Challenge! </Button>
    </CardFooter>
  </Card>
</template>
