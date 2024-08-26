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
</script>

<template>
  <MaxWidthWrapper class="flex h-screen flex-col justify-start pt-10 md:pt-24">
    <main>
      <Link :href="route('home')" class="flex w-full justify-center py-8">
        <img :src="'images/RCEdu.svg'" alt="logo" class="w-32" />
      </Link>
      <Card class="mx-auto max-w-lg shadow-none md:min-w-[500px]">
        <CardHeader class="items-center">
          <CardTitle class="text-xl"> Login to RunCloud Edu </CardTitle>
          <CardDescription> Look who is coming back! </CardDescription>
        </CardHeader>
        <CardContent>
          <div class="grid gap-8">
            <SocialLinkButton />
            <Separator label="OR" />
            <div class="grid gap-4">
              <div class="grid gap-2">
                <Label for="email">Email</Label>
                <Input
                  id="email"
                  type="email"
                  placeholder="john@example.com"
                  required
                />
              </div>
              <div class="grid gap-2">
                <div class="flex items-center">
                  <Label for="password">Password</Label>
                  <a href="#" class="ml-auto inline-block text-sm underline">
                    Forgot your password?
                  </a>
                </div>
                <Input id="password" type="password" placeholder="********" />
              </div>
              <Button type="submit" class="w-full"> Login </Button>
            </div>
          </div>
          <div class="mt-4 text-center text-sm">
            Don't have an account?
            <Link :href="route('signup')" class="underline"> Sign Up </Link>
          </div>
        </CardContent>
      </Card>
    </main>
  </MaxWidthWrapper>
</template>
