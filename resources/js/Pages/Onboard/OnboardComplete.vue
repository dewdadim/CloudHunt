<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import ConfettiExplosion from 'vue-confetti-explosion'
import {
  Card,
  CardContent,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Link } from '@inertiajs/vue3'

const props = defineProps<{
  auth: {
    user: {
      username: string
      prefer_name: string
      avatar: string
    }
  }
}>()
</script>

<template>
  <MaxWidthWrapper class="pt-10">
    <main class="my-16 flex flex-col items-center gap-2">
      <Card class="mx-auto w-full max-w-lg md:max-w-[500px]">
        <CardHeader class="justify-center text-center">
          <CardTitle>
            All Set! Welcome {{ props.auth.user.prefer_name ?? '' }}
            to CloudHunt
          </CardTitle>
        </CardHeader>
        <CardContent v-auto-animate>
          <div class="flex flex-col items-center gap-2 text-center">
            <ConfettiExplosion
              class="animate-disappear"
              :stageWidth="300"
              :stageHeight="650"
              :particleCount="70"
              :particleSize="6"
              :duration="3000"
            />
            <p
              class="motion-preset-shake motion-duration-2000 z-20 mb-6 pl-8 text-9xl"
            >
              🎉
            </p>
            <p>
              The bright future has been set for you! <br />
              Start learning with CloudHunt.
            </p>
          </div>
        </CardContent>
        <CardFooter>
          <Link class="w-full" href="/lessons/fundamentals-of-cloud-computing">
            <Button class="w-full" size="lg">Continue Journey!</Button>
          </Link>
        </CardFooter>
      </Card>
    </main>
  </MaxWidthWrapper>
</template>
