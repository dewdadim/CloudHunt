<script setup lang="ts">
import { BriefcaseBusiness, Cake, Mail } from 'lucide-vue-next'
import { Button } from '../ui/button'
import { Card, CardContent } from '../ui/card'
import { Separator } from '../ui/separator'
import { Link, usePage } from '@inertiajs/vue3'

const authUser: AuthUser = usePage().props.auth.user

const props = defineProps<{
  user: User
}>()
</script>

<template>
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
      <div class="mb-4 flex flex-col gap-4">
        <div>
          <h2 class="text-2xl font-bold">{{ props.user.full_name }}</h2>
          <p class="text-sm text-muted-foreground">
            @{{ props.user.username }}
          </p>
        </div>
        <Link :href="route('settings')">
          <Button
            v-if="authUser.id === props.user.id"
            variant="secondary"
            class="w-full"
          >
            Edit Profile
          </Button>
        </Link>
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
            <BriefcaseBusiness class="size-4" />
            {{ props.user.occupation }}
          </p>
          <p class="flex items-center gap-1">
            <Cake class="size-4" />
            {{
              new Date(props.user.date_of_birth).toLocaleDateString('en-UK', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
              })
            }}
          </p>
        </div>
      </div>
      <Separator class="my-2" />
      <div class="my-2">
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
