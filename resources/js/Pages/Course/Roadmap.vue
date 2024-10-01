<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import Navbar from './Navbar.vue'
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { MonitorPlay, MousePointerClick, Puzzle } from 'lucide-vue-next'
import { cn } from '@/lib/utils'
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area'
import { Link } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { Button } from '@/components/ui/button'

const { course } = defineProps<{
  course: Course
}>()

const chapters = computed<Chapter[]>(() => course.chapters!)

const currentChapter = ref(0)
</script>

<template>
  <Navbar :course="course!" />
  <MaxWidthWrapper class="md:max-w-screen-xl">
    <div class="mt-6 flex w-full items-center justify-center md:mt-12">
      <Card class="shadow-0 w-full gap-4 border-none bg-white/0">
        <CardHeader
          class="flex-row items-center justify-center gap-4 text-center md:gap-8"
        >
          <div>
            <CardDescription>
              Chapter
              {{
                chapters
                  .map((e) => e.uri)
                  .indexOf(chapters[currentChapter].uri) + 1
              }}
            </CardDescription>
            <CardTitle>{{ chapters[currentChapter].title }}</CardTitle>
          </div>
          <Button
            v-on:click="currentChapter -= 1"
            :disabled="currentChapter === 0"
            >Previous</Button
          >
          <Button
            v-on:click="currentChapter += 1"
            :disabled="currentChapter >= chapters.length - 1"
            >Next</Button
          >
        </CardHeader>
        <CardContent
          class="mt-2 flex flex-col items-center p-0 md:mt-12 lg:flex-row lg:justify-center"
        >
          <ScrollArea class="w-fit whitespace-nowrap lg:w-10/12">
            <div class="flex flex-col pt-6 md:p-6 md:pb-12 lg:flex-row">
              <div
                class="grid w-max grid-cols-2 lg:grid-cols-1"
                v-for="(i, index) in chapters[currentChapter].modules"
                :key="i.id"
              >
                <Link
                  :href="
                    route('modules.show', {
                      course: course.uri,
                      chapter: chapters[currentChapter].uri,
                      module: i.uri,
                    })
                  "
                  :class="
                    cn(
                      'group relative flex h-56 items-center transition hover:-translate-y-2 hover:cursor-pointer',
                      chapters[currentChapter].modules.indexOf(i) % 2 !== 0
                        ? 'order-last'
                        : 'order-first justify-end',
                    )
                  "
                >
                  <div
                    :class="
                      cn(
                        'flex h-full w-48 flex-col items-center justify-center gap-3 rounded-3xl bg-card p-2 text-center transition',
                        i.isDone
                          ? 'border-4 border-primary bg-yellow-50 text-primary shadow-lg shadow-primary'
                          : 'border text-slate-600 shadow-taper group-hover:bg-slate-50',
                      )
                    "
                  >
                    <component
                      :is="
                        i.category == 'video'
                          ? MonitorPlay
                          : i.category == 'quiz'
                            ? Puzzle
                            : MousePointerClick
                      "
                      class="size-14 stroke-[1.2px]"
                    />
                    <h3 class="text-wrap font-semibold">{{ i.title }}</h3>
                  </div>
                </Link>
                <div
                  :class="
                    cn(
                      'flex h-64 w-full items-end',
                      chapters[currentChapter].modules.indexOf(i) % 2 !== 0
                        ? 'justify-end lg:justify-end'
                        : 'justify-start lg:items-start lg:justify-end',
                    )
                  "
                >
                  <div
                    v-if="index + 1 !== chapters[currentChapter].modules.length"
                    :class="
                      cn(
                        '-z-10 h-2/3 w-1/2 rounded-bl-[52px] border-b-4 border-l-4 border-dashed',
                        chapters[currentChapter].modules.indexOf(i) % 2 !== 0
                          ? 'scale-y-[-1]'
                          : 'rotate-180 lg:rotate-0',
                        i.isDone ? 'border-primary' : 'border-slate-400',
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
