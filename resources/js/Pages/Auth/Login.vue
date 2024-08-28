<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Separator } from '@/components/ui/separator'
import SocialLinkButton from '@/components/SocialAuth.vue'

import { useForm } from '@inertiajs/vue3'
import { Loader2 } from 'lucide-vue-next'
import FormInput from '@/components/FormInput.vue'

const form = useForm({
  email: null,
  password: null,
})

function submit() {
  form.post(route('login'))
}
</script>

<template>
  <MaxWidthWrapper class="h-screen pt-10 md:pt-24">
    <main class="flex flex-col items-center">
      <div class="mb-6 w-fit">
        <Link :href="route('home')">
          <img :src="'images/RCEdu.svg'" alt="logo" class="w-32" />
        </Link>
      </div>
      <Card class="mx-auto max-w-lg shadow-none md:min-w-[500px]">
        <CardHeader class="items-center">
          <CardTitle class="text-xl"> Login to RunCloud Edu </CardTitle>
          <CardDescription> Look who is coming back! </CardDescription>
        </CardHeader>
        <CardContent>
          <div class="grid gap-8">
            <SocialLinkButton />
            <Separator label="OR" />
            <form @submit.prevent="submit" class="grid gap-4">
              <FormInput
                name="Email"
                placeholder="name@mail.com"
                v-model="form.email"
                :message="form.errors.email"
              />
              <FormInput
                name="Password"
                type="password"
                placeholder="********"
                v-model="form.password"
                :message="form.errors.password"
              />
              <Button type="submit" class="w-full" :disabled="form.processing">
                <Loader2 v-if="form.processing" class="mr-2 animate-spin" />
                Login
              </Button>
            </form>
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
