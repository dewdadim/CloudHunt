<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card'
import Navbar from './Navbar.vue'
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { cn } from '@/lib/utils'
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area'
import ModuleCard from '@/components/ModuleCard.vue'

const { lesson, progress } = defineProps<{
  lesson: Lesson
  progress: Progress
}>()

console.log(lesson)
console.log(progress)
</script>

<template>
  <Navbar :lesson="lesson!" />
  <MaxWidthWrapper class="md:max-w-screen-xl">
    <div class="mt-6 flex w-full items-center justify-center md:mt-12">
      <Card class="shadow-0 w-full gap-4 border-none bg-white/0">
        <CardContent
          class="mt-2 flex flex-col items-center p-0 md:mt-12 lg:flex-row lg:justify-center"
        >
          <ScrollArea class="w-fit whitespace-nowrap lg:w-full">
            <div class="flex flex-col pt-6 md:p-6 md:pb-12 lg:flex-row">
              <div
                class="grid w-max grid-cols-2 md:place-items-start lg:grid-cols-1"
                v-for="(i, index) in lesson.modules"
                :key="i.id"
              >
                <div
                  :class="
                    cn(
                      'group relative flex h-52 items-center transition hover:-translate-y-2',
                      index % 2 !== 0
                        ? 'order-last'
                        : 'order-first justify-end',
                    )
                  "
                >
                  <ModuleCard
                    :module="i"
                    :lesson-uri="lesson.uri"
                    :progress="progress"
                  />
                </div>
                <div
                  :class="
                    cn(
                      'flex h-80 w-full items-end lg:w-64',
                      index + 1 === lesson.modules.length && 'lg:w-full',
                      index % 2 !== 0
                        ? 'justify-end lg:justify-end'
                        : 'justify-start lg:items-start lg:justify-end',
                    )
                  "
                >
                  <div
                    v-if="index + 1 !== lesson.modules.length"
                    :class="
                      cn(
                        '-z-10 h-2/3 w-1/2 rounded-bl-[52px] border-b-4 border-l-4 border-dashed lg:w-2/3',
                        index % 2 !== 0
                          ? 'scale-y-[-1]'
                          : 'rotate-180 lg:rotate-0',
                        progress[i.id]?.completed
                          ? 'border-primary'
                          : 'border-slate-400',
                      )
                    "
                  />
                </div>
              </div>
              <ScrollBar orientation="horizontal" class="h-1.5" />
            </div>
          </ScrollArea>
        </CardContent>
      </Card>
    </div>
  </MaxWidthWrapper>
</template>
