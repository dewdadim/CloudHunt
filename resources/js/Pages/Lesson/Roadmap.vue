<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card'
import Navbar from './Navbar.vue'
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { cn } from '@/lib/utils'
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area'
import ModuleCard from '@/components/ModuleCard.vue'
import { computed, ref } from 'vue'
import { AspectRatio } from '@/components/ui/aspect-ratio'
import { Progress } from '@/components/ui/progress'
import { BrainCircuit, CheckCircle2 } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'

const props = defineProps<{
  lesson: Lesson
  modules: Module[]
}>()

// Calculate the progress percentage based on the current step
const progressPercentage = computed(() => {
  return (
    (props.modules.filter((e) => e.completed == true).length /
      props.modules.length) *
    100
  )
})

const progress = ref(progressPercentage ?? 0)
</script>

<!-- <template>
  <Navbar :lesson="lesson!" />
  <MaxWidthWrapper class="md:max-w-screen-xl">
    <div class="mt-6 flex w-full items-center justify-center md:mt-8">
      <Card class="shadow-0 w-full gap-4 border-none bg-white/0">
        <CardContent
          class="mt-2 flex flex-col items-center p-0 md:mt-12 lg:flex-row lg:justify-center"
        >
          <ScrollArea class="w-fit whitespace-nowrap lg:w-full">
            <div class="flex flex-col pt-6 md:p-6 md:pb-12 lg:flex-row">
              <div
                class="grid w-max grid-cols-2 md:place-items-start lg:grid-cols-1"
                v-for="(i, index) in modules"
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
                  <ModuleCard :module="i" :lesson-uri="lesson.uri" />
                </div>
                <div
                  :class="
                    cn(
                      'flex h-80 w-full items-end lg:w-64',
                      index + 1 === modules.length && 'lg:w-full',
                      index % 2 !== 0
                        ? 'justify-end lg:justify-end'
                        : 'justify-start lg:items-start lg:justify-end',
                    )
                  "
                >
                  <div
                    v-if="index + 1 !== modules.length"
                    :class="
                      cn(
                        '-z-10 h-2/3 w-1/2 rounded-bl-[52px] border-b-4 border-l-4 border-dashed lg:w-2/3',
                        index % 2 !== 0
                          ? 'scale-y-[-1]'
                          : 'rotate-180 lg:rotate-0',
                        i?.completed ? 'border-primary' : 'border-slate-400',
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
</template> -->
<template>
  <Navbar :lesson="lesson!" />
  <MaxWidthWrapper>
    <main
      class="mx-auto mb-12 mt-4 flex max-w-[400px] flex-col gap-8 overflow-x-visible md:mt-12 md:max-w-screen-lg md:flex-row lg:gap-8"
    >
      <div class="min-w-full md:min-w-[350px]">
        <div class="sticky top-28 w-full md:w-[350px]">
          <div class="sticky top-28">
            <div class="relative rounded-3xl shadow-taper">
              <!-- status badge -->
              <div
                class="absolute left-2.5 top-2.5 z-10 flex w-fit items-center gap-1 rounded-full bg-yellow-100/40 px-3 py-2 text-xs font-semibold text-yellow-500"
                v-if="progress >= 100"
              >
                <CheckCircle2 :size="16" :stroke-width="2.5" />
                Completed
              </div>

              <AspectRatio :ratio="7 / 3" class="rounded-3xl bg-muted">
                <img
                  :src="
                    props.lesson.thumbnail ??
                    'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80'
                  "
                  alt="Photo by Drew Beamer"
                  class="h-full w-full rounded-t-3xl border-x border-t object-cover"
                />
                <div
                  class="h-fit w-full border-l border-r"
                  v-if="progress < 100 && progress > 0"
                >
                  <Progress :modelValue="progress" class="h-1 rounded-none" />
                </div>
              </AspectRatio>
              <div
                class="w-full space-y-8 rounded-b-3xl border-x border-b bg-card p-6"
              >
                <h3 class="line-clamp-2 text-wrap text-lg font-semibold">
                  {{ props.lesson.title }}
                </h3>
                <p>{{ props.lesson.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex w-full flex-col gap-4">
        <Link
          :href="
            route('modules.show', {
              lesson: props.lesson.uri,
              module: module.uri,
            })
          "
          v-for="module in props.modules"
          :class="
            cn(
              'flex h-20 items-center justify-between rounded-2xl border bg-card px-8 shadow-taper',
              module.completed &&
                'bg-border-4 border-primary bg-yellow-50 text-primary shadow-lg shadow-primary',
            )
          "
        >
          <div class="flex items-center gap-4">
            <BrainCircuit />
            <h3 class="font-medium">{{ module.title }}</h3>
          </div>
          <CheckCircle2
            :size="32"
            :class="module.completed ? 'text-primary' : 'text-gray-300'"
          />
        </Link>
      </div>
    </main>
  </MaxWidthWrapper>
</template>
