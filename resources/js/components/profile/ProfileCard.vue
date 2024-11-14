<script setup lang="ts">
import { Building, Building2, Cake, Mail, PartyPopper } from 'lucide-vue-next'
import { Button } from '../ui/button'
import { Card, CardContent, CardFooter } from '../ui/card'
import { Separator } from '../ui/separator'

const props = defineProps<{
  user: User
}>()
</script>

<template>
  <!-- <div class="w-full rounded-2xl shadow-taper">
    <div class="relative h-24 w-full rounded-t-2xl border bg-primary">
      <div class="absolute -bottom-1/2 left-6 w-24">
        <AspectRatio :ratio="1 / 1" class="rounded-2xl bg-muted">
          <img :src="user.avatar" class="h-full w-full rounded-2xl border" />
        </AspectRatio>
      </div>
    </div>

    <div
      class="h-72 w-full rounded-b-2xl border-b border-l border-r bg-card"
    ></div>
  </div> -->
  <Card class="mx-auto w-full max-w-md overflow-hidden">
    <div class="relative">
      <div
        class="h-24 bg-gradient-to-tr from-primary to-yellow-200 bg-cover bg-center"
      />
      <div class="absolute bottom-0 left-4 translate-y-1/2 transform">
        <div class="rounded-2xl">
          <img
            :src="props.user.avatar"
            :alt="`${props.user.avatar}'s avatar`"
            class="size-24 rounded-2xl border-2 border-card object-cover"
          />
        </div>
      </div>
    </div>
    <CardContent class="pb-4 pt-12">
      <div class="mb-4 flex items-start justify-between">
        <div>
          <h2 class="text-2xl font-bold">{{ props.user.full_name }}</h2>
          <p class="text-sm text-muted-foreground">
            @{{ props.user.username }}
          </p>
        </div>
      </div>
      <Separator class="my-2" />
      <div class="text-sm">
        <h3 class="text-base font-bold">About {{ props.user.prefer_name }}</h3>
        <div class="mt-2 grid gap-1">
          <p class="flex items-center gap-1">
            <Mail class="size-4" />
            {{ props.user.email }}
          </p>
          <p class="flex items-center gap-1">
            <Building class="size-4" />
            {{ props.user.occupation }}
          </p>
          <p class="flex items-center gap-1">
            <Cake class="size-4" />
            {{ props.user.date_of_birth }}
          </p>
        </div>
      </div>
      <Separator class="my-2" />
      <div>
        <h3 class="text-md font-bold">Badges</h3>
        <div class="mt-2 grid grid-cols-4 gap-2">
          <img
            :src="'../badges/cloudhunt_rank-2.svg'"
            :alt="`${props.user.avatar}'s avatar`"
            class="size-16"
          />
          <img
            :src="'../badges/cloudhunt_rank-1.svg'"
            :alt="`${props.user.avatar}'s avatar`"
            class="size-16"
          />
          <img
            :src="'../badges/cloudhunt_rank-2.svg'"
            :alt="`${props.user.avatar}'s avatar`"
            class="size-16"
          />
          <img
            :src="'../badges/cloudhunt_rank-1.svg'"
            :alt="`${props.user.avatar}'s avatar`"
            class="size-16"
          />
          <img
            :src="'../badges/cloudhunt_rank-3.svg'"
            :alt="`${props.user.avatar}'s avatar`"
            class="size-16"
          />
          <img
            :src="'../badges/cloudhunt_rank-3.svg'"
            :alt="`${props.user.avatar}'s avatar`"
            class="size-16"
          />
        </div>
      </div>
    </CardContent>
  </Card>
</template>
