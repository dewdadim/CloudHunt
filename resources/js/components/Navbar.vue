<script setup lang="ts">
import { Bell, Inbox, Search } from 'lucide-vue-next'
import { Button } from './ui/button'
import { Popover, PopoverContent, PopoverTrigger } from './ui/popover'
</script>

<template>
  <nav
    class="fixed top-0 z-10 flex w-full justify-between border-b bg-background px-6 py-2"
  >
    <div class="flex items-center gap-8">
      <Link :href="route('home')">
        <img :src="'images/RCEdu.svg'" alt="logo" class="w-28" />
      </Link>
      <ul class="flex items-center gap-6">
        <li><Link href="#">Home</Link></li>
        <li><Link href="#">Courses</Link></li>
      </ul>
    </div>
    <div class="flex items-center gap-2">
      <Button class="min-w-64 justify-start gap-2" variant="secondary">
        <Search />
        Search
      </Button>
      <Button size="icon" variant="secondary">
        <Inbox :size="20" />
      </Button>
      <Button size="icon" variant="secondary">
        <Bell :size="20" />
      </Button>
      <Popover>
        <PopoverTrigger as-child>
          <img
            :src="'images/pfp.jpg'"
            alt="avatar"
            class="size-10 cursor-pointer rounded-xl border"
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
  </nav>
</template>
