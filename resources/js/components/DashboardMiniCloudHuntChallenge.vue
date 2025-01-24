<script setup lang="ts">
import { Timer } from 'lucide-vue-next'
import { Button } from './ui/button'
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter,
} from './ui/card'
import { Link } from '@inertiajs/vue3'
import { cn } from '@/lib/utils'

const props = defineProps<{
  user_ranking: User[]
}>()

const topUser: User[] = props.user_ranking.slice(0, 3)
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
          v-for="(user, index) in topUser"
          class="h-fit bg-gradient-to-b from-slate-200/0 from-5% via-slate-200/20 to-slate-500/0 pt-2"
        >
          <div
            :class="
              cn(
                'flex min-w-20 flex-col items-center gap-1',
                index === 1
                  ? 'mb-6'
                  : index === 3
                    ? 'mb-12'
                    : index === 2
                      ? 'mb-3'
                      : '',
              )
            "
          >
            <img
              :src="
                index == 1
                  ? '/badges/cloudhunt_rank-1.svg'
                  : index == 2
                    ? '/badges/cloudhunt_rank-2.svg'
                    : '/badges/cloudhunt_rank-3.svg'
              "
              class="size-32"
            />
            <div
              class="flex flex-col items-center text-xs md:text-sm lg:text-base"
            >
              <img :src="user.avatar" class="w-1/3 rounded-lg border" />
              <div class="w-24 overflow-hidden text-center">
                <Link
                  :href="route('users.show', { id: user.username })"
                  class="group"
                >
                  <p class="truncate text-sm group-hover:underline">
                    @{{ user.username }}
                  </p>
                </Link>
              </div>
              <p class="flex items-center gap-0.5 text-xs">
                <Timer :size="14" />{{ user.xp }}
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
