<script setup lang="ts">
import { Bell, Inbox, Search } from 'lucide-vue-next'
import { Button } from './ui/button'
import { Popover, PopoverContent, PopoverTrigger } from './ui/popover'
import MaxWidthWrapper from './MaxWidthWrapper.vue'
</script>

<template>
  <nav class="sticky top-0 z-10 w-full border-b bg-background">
    <MaxWidthWrapper class="flex justify-between py-3 md:max-w-screen-xl">
      <div class="flex items-center gap-8">
        <Link :href="route('dashboard')" class="hidden md:inline-flex">
          <img :src="'../images/RCEdu.svg'" alt="logo" class="w-28" />
        </Link>
        <ul class="flex items-center gap-6">
          <li>
            <Link
              :href="route('dashboard')"
              :class="$page.url == '/dashboard' ? 'border-b-2 font-bold' : ''"
              >Dashboard</Link
            >
          </li>
          <li>
            <Link
              :href="route('courses')"
              :class="$page.url == '/courses' ? 'border-b-2 font-bold' : ''"
              >Courses</Link
            >
          </li>
          <li><Link href="#">News</Link></li>
        </ul>
      </div>
      <div class="flex items-center gap-2">
        <!-- <Button class="w-48 justify-start gap-2 bg-white/50" variant="ghost">
          <Search :size="20" />
          <p class="hidden md:inline">Search</p>
        </Button> -->
        <!-- <Button size="icon" variant="ghost">
          <Inbox :size="20" />
        </Button> -->
        <Button size="icon" variant="ghost" class="bg-white/50">
          <Bell :size="20" />
        </Button>
        <Popover>
          <PopoverTrigger as-child>
            <img
              :src="'../images/pfp.jpg'"
              alt="avatar"
              class="size-10 cursor-pointer rounded-xl"
            />
          </PopoverTrigger>
          <PopoverContent class="w-auto min-w-56 max-w-64" align="end">
            <div class="flex flex-col gap-4">
              <div class="flex items-center gap-4 rounded-md p-2">
                <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  replace
                  class="w-full py-2 hover:bg-slate-200"
                >
                  Logout
                </Link>
              </div>
            </div>
          </PopoverContent>
        </Popover>
      </div>
    </MaxWidthWrapper>
  </nav>
</template>
