<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Separator } from '@/components/ui/separator'
import { route } from '../../../../vendor/tightenco/ziggy/src/js'
import SocialLinkButton from '@/components/SocialAuth.vue'

import { useForm } from '@inertiajs/vue3'

const form = useForm({
  username: null,
  email: null,
  password: null,
})

function submit() {
  form.post('/signup')
}
</script>

<template>
  <MaxWidthWrapper class="flex h-screen flex-col justify-start pt-10 md:pt-24">
    <main>
      <Link :href="route('home')" class="flex w-full justify-center py-8">
        <img :src="'images/RCEdu.svg'" alt="logo" class="w-32" />
      </Link>
      <Card class="mx-auto max-w-lg shadow-none md:min-w-[500px]">
        <CardHeader class="items-center">
          <CardTitle class="text-xl"> Sign Up to RunCloud Edu </CardTitle>
          <CardDescription>
            Start your cloud computing adventure now!
          </CardDescription>
        </CardHeader>
        <CardContent>
          <div class="grid gap-8">
            <SocialLinkButton />
            <Separator label="OR" />
            <form @submit.prevent="submit" class="grid gap-4">
              <div class="grid gap-2">
                <Label for="username">Username</Label>
                <Input
                  id="username"
                  v-model="form.username!"
                  placeholder="johncena"
                  required
                />
              </div>
              <div class="grid gap-2">
                <Label for="email">Email</Label>
                <Input
                  id="email"
                  v-model="form.email!"
                  type="email"
                  placeholder="john@example.com"
                  required
                />
              </div>
              <div class="grid gap-2">
                <Label for="password">Password</Label>
                <Input
                  id="password"
                  v-model="form.password!"
                  type="password"
                  placeholder="********"
                />
              </div>
              <Button type="submit" class="w-full"> Create an account </Button>
            </form>
          </div>
          <div class="mt-4 text-center text-sm">
            Already have an account?
            <Link :href="route('login')" class="underline"> Login </Link>
          </div>
        </CardContent>
      </Card>
    </main>
  </MaxWidthWrapper>
</template>
