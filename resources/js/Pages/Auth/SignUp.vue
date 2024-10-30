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
import { Loader2 } from 'lucide-vue-next'
import FormInput from '@/components/FormInput.vue'

import { useForm } from '@inertiajs/vue3'

const form = useForm({
  username: null,
  email: null,
  password: null,
  password_confirmation: null,
})

const submit = () => {
  form.post(route('signup'), {
    replace: true,
  })
}
</script>

<template>
  <MaxWidthWrapper class="h-screen pt-10 md:pt-24">
    <main class="flex flex-col items-center">
      <div class="mb-6 w-fit">
        <Link :href="route('home')" class="text-3xl font-extrabold">
          <!-- <img :src="'images/RCEdu.svg'" alt="logo" class="w-32" /> -->
          CloudHunt
        </Link>
      </div>
      <Card class="mx-auto w-full max-w-lg md:max-w-[500px]">
        <CardHeader class="items-center">
          <CardTitle class="text-xl"> Sign Up to CloudHunt </CardTitle>
          <CardDescription>
            Start your cloud computing adventure now!
          </CardDescription>
        </CardHeader>
        <CardContent>
          <div class="grid gap-8">
            <SocialLinkButton />
            <Separator label="OR" />
            <form @submit.prevent="submit" class="grid gap-4">
              <!-- <FormInput
                name="Username"
                placeholder="username123"
                v-model="form.username"
                :message="form.errors.username"
              /> -->
              <FormInput
                name="Email"
                type="email"
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
              <FormInput
                name="Confirm Password"
                type="password"
                placeholder="********"
                v-model="form.password_confirmation"
                :message="form.errors.password_confirmation"
              />
              <Button type="submit" class="w-full" :disabled="form.processing">
                <Loader2 v-if="form.processing" class="mr-2 animate-spin" />
                Create an account
              </Button>
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
