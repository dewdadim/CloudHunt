<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import MiniCloudHuntChallenge from '@/components/DashboardMiniCloudHuntChallenge.vue'
import ContinueLesson from '@/components/DashboardContinueLesson.vue'

import JumpBackIn from '@/components/DashboardJumpBackIn.vue'
import DashboardProfileCard from '@/components/DashboardProfileCard.vue'
import DashboardNews from '@/components/DashboardNews.vue'
import DashboardUserRanking from '@/components/DashboardUserRanking.vue'

const props = defineProps<{
  lessons: Lesson[]
  user_ranking: User[]
  user: AuthUser
}>()
</script>

<template>
  <main
    class="mx-auto mb-12 mt-4 flex max-w-[400px] flex-col gap-8 overflow-x-visible md:mt-12 md:max-w-screen-lg md:flex-row lg:gap-8"
  >
    <div class="min-w-full md:min-w-[350px]">
      <div class="sticky top-28 w-full space-y-4 md:w-[350px]">
        <h2 class="text-xl font-semibold">
          Welcome, {{ props.user.prefer_name }} 👋
        </h2>
        <DashboardProfileCard :user="props.user" :lessons="props.lessons" />
        <DashboardUserRanking
          :user="props.user"
          :user_ranking="props.user_ranking"
        />
      </div>
    </div>
    <div class="flex w-full flex-col gap-8">
      <JumpBackIn :lesson="props.lessons[0]" v-if="props.lessons.length" />

      <DashboardNews />
      <ContinueLesson :lessons="props.lessons" v-if="props.lessons.length" />
    </div>
  </main>
</template>
