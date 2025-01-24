<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from './ui/card'

import { cn } from '@/lib/utils'
import { ScrollArea, ScrollBar } from './ui/scroll-area'

const props = defineProps<{
  user_ranking: User[]
  user: AuthUser
}>()
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle> Ranking </CardTitle>
    </CardHeader>
    <CardContent>
      <ScrollArea class="h-52" :scroll-hide-delay="1">
        <div class="space-y-2">
          <div
            v-for="(user, index) in props.user_ranking"
            :class="
              cn(
                'flex items-center justify-between rounded-xl px-4 py-2 hover:bg-accent',
                user.username == props.user.username &&
                  'bg-primary/20 font-semibold hover:bg-primary/30',
              )
            "
          >
            <div class="flex items-center gap-2">
              <p>{{ index + 1 }}</p>
              <p>{{ user.prefer_name }}</p>
              <p v-if="user.username == props.user.username">(You)</p>
            </div>
            <p>{{ user.xp }}</p>
          </div>
        </div>
      </ScrollArea>
    </CardContent>
  </Card>
</template>
