<script setup lang="ts">
import Navbar from './Navbar.vue'
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { computed, ref } from 'vue'
import LessonOverview from './LessonOverview.vue'
import LessonAllModules from './LessonAllModules.vue'

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
console.log(props.modules)
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
            <LessonOverview
              :lesson="props.lesson"
              :modules="props.modules"
              :progress="progress"
            />
          </div>
        </div>
      </div>
      <div class="flex w-full flex-col gap-4">
        <LessonAllModules :lesson="lesson" :modules="props.modules" />
      </div>
    </main>
  </MaxWidthWrapper>
</template>
