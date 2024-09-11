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
      <div class="flex gap-4">
        <div class="relative flex h-44 w-32 flex-col items-center gap-2">
          <img :src="'../badges/cloudhunt_rank-2.svg'" class="z-10 size-32" />
          <p>@nadimhairi</p>
          <div
            class="absolute top-4 h-52 w-28 bg-gradient-to-b from-white/20 to-white/0"
          />
        </div>
        <div class="relative flex h-44 w-32 flex-col items-center gap-1">
          <img :src="'../badges/cloudhunt_rank-1.svg'" class="z-10 size-32" />
          <p>@nadimhairi</p>
          <p class="flex items-center gap-1 text-sm">
            <Timer :size="16" /> 00:21:02
          </p>
          <div
            class="absolute top-4 h-52 w-28 bg-gradient-to-b from-white/20 to-white/0"
          />
        </div>
        <div class="relative flex h-44 w-32 flex-col items-center gap-2">
          <img
            :src="'../badges/cloudhunt_rank-3.svg'"
            class="top-20 z-10 size-32"
          />
          <p>@nadimhairi</p>
          <div
            class="absolute top-4 h-52 w-28 bg-gradient-to-b from-white/20 to-white/0"
          />
        </div>
      </div>
    </CardContent>
    <CardFooter class="mt-8">
      <Button class="w-full" size="lg"> Begin Challenge! </Button>
    </CardFooter>
  </Card>
</template>
