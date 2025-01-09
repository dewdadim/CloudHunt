<script setup lang="ts">
import { Bell, HelpCircle, LogOut, Settings, User } from 'lucide-vue-next'
import { Button } from './ui/button'
import { Popover, PopoverContent, PopoverTrigger } from './ui/popover'
import MaxWidthWrapper from './MaxWidthWrapper.vue'
import { Separator } from './ui/separator'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()
const user = page.props.auth.user

console.log(user)
</script>

<template>
  <nav class="sticky top-0 z-10 w-full border-b bg-background">
    <MaxWidthWrapper class="flex justify-between py-3 md:max-w-screen-xl">
      <div class="flex items-center gap-8">
        <Link
          :href="route('dashboard')"
          class="hidden text-xl font-extrabold md:inline-flex"
        >
          <!-- <img :src="'../images/RCEdu.svg'" alt="logo" class="w-28" /> -->
          CloudHunt
        </Link>
        <ul class="flex items-center gap-6">
          <li>
            <Link
              :href="route('dashboard')"
              :class="page.url == '/dashboard' ? 'border-b-2 font-bold' : ''"
            >
              Dashboard
            </Link>
          </li>
          <li>
            <Link
              :href="route('lessons')"
              :class="page.url == '/lessons' ? 'border-b-2 font-bold' : ''"
            >
              Lessons
            </Link>
          </li>
        </ul>
      </div>
      <div class="flex items-center gap-3">
        <Button size="icon" variant="ghost">
          <Settings :size="24" />
        </Button>
        <Button size="icon" variant="ghost">
          <Bell :size="24" />
        </Button>
        <Popover>
          <PopoverTrigger class="cursor-pointer" as-child>
            <img :src="user.avatar" alt="avatar" class="size-10 rounded-xl" />
          </PopoverTrigger>
          <PopoverContent class="w-auto min-w-60 max-w-64" align="end">
            <div class="flex flex-col gap-2">
              <div class="flex items-center gap-4 py-4">
                <img
                  :src="user.avatar"
                  alt="avatar"
                  class="size-16 rounded-xl border"
                />
                <div>
                  <h3 class="font-semibold">
                    {{ user.prefer_name }}
                  </h3>
                  <p class="text-xs">@{{ user.username }}</p>
                </div>
              </div>

              <!-- <Separator />

              <Link
                :href="route('users.show', { id: user.username })"
                class="flex items-center justify-start gap-2 rounded-md p-2 hover:bg-accent"
              >
                <User :size="20" />
                Profile
              </Link> -->

              <Separator />

              <Link
                :href="'#'"
                class="flex cursor-pointer items-center justify-start gap-2 rounded-md p-2 hover:bg-accent"
              >
                <HelpCircle :size="20" />
                Help & Supports
              </Link>
              <Link
                :href="route('settings')"
                class="flex cursor-pointer items-center justify-start gap-2 rounded-md p-2 hover:bg-accent"
              >
                <Settings :size="20" />
                Settings
              </Link>

              <Separator />

              <Link
                :href="route('logout')"
                method="post"
                as="button"
                replace
                class="flex cursor-pointer items-center justify-start gap-2 rounded-md p-2 hover:bg-accent"
              >
                <LogOut :size="20" />
                Logout
              </Link>
            </div>
          </PopoverContent>
        </Popover>
      </div>
    </MaxWidthWrapper>
  </nav>
</template>
