<script setup lang="ts">
import { HelpCircle, Slash, StarsIcon } from 'lucide-vue-next'

import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import {
  Breadcrumb,
  BreadcrumbList,
  BreadcrumbSeparator,
  BreadcrumbItem,
  BreadcrumbPage,
} from '@/components/ui/breadcrumb'
import { Button } from '@/components/ui/button'
import { Link, usePage } from '@inertiajs/vue3'

const { lesson } = defineProps<{
  lesson: Lesson
}>()

const user = usePage().props.auth.user
</script>

<template>
  <nav class="sticky top-0 z-10 w-full bg-background/95 backdrop-blur">
    <MaxWidthWrapper
      class="flex items-center justify-between py-4 md:max-w-screen-2xl"
    >
      <div class="flex flex-wrap items-center gap-4">
        <Link :href="route('dashboard')" class="text-xl font-extrabold">
          <!-- <img :src="'/images/RCEdu.svg'" alt="logo" class="w-28" /> -->
          CloudHunt
        </Link>
        <Breadcrumb class="hidden md:inline-flex">
          <BreadcrumbList>
            <BreadcrumbItem>
              <Link :href="route('dashboard')"> Dashboard </Link>
            </BreadcrumbItem>
            <BreadcrumbSeparator class="hidden md:inline-flex">
              <Slash />
            </BreadcrumbSeparator>
            <BreadcrumbItem class="hidden md:inline-flex">
              <Link :href="route('lessons')"> Lessons </Link>
            </BreadcrumbItem>
            <BreadcrumbSeparator>
              <Slash />
            </BreadcrumbSeparator>
            <BreadcrumbItem>
              <BreadcrumbPage class="max-w-48 truncate md:max-w-full">
                {{ lesson.title }}
              </BreadcrumbPage>
            </BreadcrumbItem>
          </BreadcrumbList>
        </Breadcrumb>
      </div>
      <div class="flex items-center gap-1 md:gap-2">
        <Button
          variant="ghost"
          class="flex items-center gap-2 text-lg font-semibold"
        >
          <StarsIcon fill="#F9BF3B" class="text-primary" />
          {{ user.xp }}
        </Button>
        <Button variant="ghost" size="icon">
          <HelpCircle />
        </Button>
      </div>
    </MaxWidthWrapper>
  </nav>
</template>
