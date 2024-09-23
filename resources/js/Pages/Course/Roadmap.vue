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
import {
  CornerDownLeft,
  CornerLeftDown,
  CornerRightDown,
} from 'lucide-vue-next'
import { cn } from '@/lib/utils'
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area'

const { course } = defineProps<{
  course: {
    title: string
    id: number
  }
  chapters: {
    title: string
    id: number
  }
}>()

const items = [
  {
    id: 1,
    title: 'Test Module 0',
    isDone: true,
  },
  {
    id: 3,
    title: 'Test Module 1',
    isDone: true,
  },
  {
    id: 3,
    title: 'Test Module 2',
    isDone: false,
  },
  {
    id: 4,
    title: 'Test Module 3',
    isDone: false,
  },
  {
    id: 5,
    title: 'Test Module 4',
    isDone: false,
  },
  {
    id: 6,
    title: 'Test Module 5',
    isDone: false,
  },
  {
    id: 7,
    title: 'Test Module 5',
    isDone: false,
  },
]
</script>

<template>
  <Navbar :course="course" />
  <MaxWidthWrapper class="md:max-w-screen-xl">
    <div class="mt-6 flex w-full items-center justify-center md:mt-12">
      <Card class="shadow-0 w-full gap-4 border-none bg-white/0">
        <CardHeader class="text-center">
          <CardDescription>Chapter 1</CardDescription>
          <CardTitle>Introduction to Cloud Computing</CardTitle>
        </CardHeader>
        <CardContent
          class="mt-2 flex flex-col items-center p-0 lg:flex-row lg:justify-center"
        >
          <ScrollArea class="w-fit whitespace-nowrap lg:w-10/12">
            <div class="flex flex-col p-0 md:p-6 lg:flex-row">
              <div
                class="grid w-max grid-cols-2 lg:grid-cols-1"
                v-for="i in items"
              >
                <div
                  :class="
                    cn(
                      'flex h-56 items-center',
                      items.indexOf(i) % 2 !== 0
                        ? 'order-last'
                        : 'order-first justify-end',
                    )
                  "
                >
                  <div
                    class="flex h-full w-48 items-center justify-center rounded-2xl border bg-card px-0 shadow-taper"
                  >
                    {{ i.title }}
                  </div>
                </div>
                <div
                  :class="
                    cn(
                      'flex h-64 w-full items-end',
                      items.indexOf(i) % 2 !== 0
                        ? 'justify-end lg:justify-end'
                        : 'justify-start lg:items-start lg:justify-end',
                    )
                  "
                >
                  <div
                    v-if="i.id !== items.length"
                    :class="
                      cn(
                        '-z-10 h-2/3 w-1/2 rounded-bl-2xl border-b-4 border-l-4 border-dashed',
                        items.indexOf(i) % 2 !== 0
                          ? 'scale-y-[-1]'
                          : 'rotate-180 lg:rotate-0',
                        i.isDone ? 'border-primary' : 'border-slate-400',
                      )
                    "
                  />
                </div>
              </div>
              <ScrollBar orientation="horizontal" />
            </div>
          </ScrollArea>
        </CardContent>
      </Card>
    </div>
  </MaxWidthWrapper>
</template>
