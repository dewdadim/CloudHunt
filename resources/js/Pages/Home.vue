<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Button } from '@/components/ui/button'
import { reactive } from 'vue'
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Link } from '@inertiajs/vue3'
import { route } from '../../../vendor/tightenco/ziggy/src/js'

const add = (x: number, y: number) => {
  return x + y
}

const data = reactive({
  a: 0,
})
</script>

<template>
  <MaxWidthWrapper>
    <div class="mt-16 flex flex-wrap gap-2">
      <Button variant="default">Test Button</Button>
      <Button variant="secondary">Test Button</Button>
      <Button variant="ghost">Test Button</Button>
      <Button variant="link">Test Button</Button>
      <Button variant="outline">Test Button</Button>
      <Button variant="destructive">Test Button</Button>
    </div>
    <div class="mt-16 flex flex-wrap gap-2">
      <Button variant="default" size="lg">Test Button</Button>
      <Button variant="secondary" size="lg">Test Button</Button>
      <Button variant="ghost" size="lg">Test Button</Button>
      <Button variant="link" size="lg">Test Button</Button>
      <Button variant="outline" size="lg">Test Button</Button>
      <Button variant="destructive" size="lg">Test Button</Button>
    </div>
    <div class="mt-16 flex gap-4">
      <Card class="w-[350px]">
        <CardHeader>
          <CardTitle>Create project</CardTitle>
          <CardDescription
            >Deploy your new project in one-click.</CardDescription
          >
        </CardHeader>
        <CardContent>
          <form>
            <div class="grid w-full items-center gap-4">
              <div class="flex flex-col space-y-1.5">
                <Label for="name">Name</Label>
                <Input id="name" placeholder="Name of your project" />
              </div>
              <div class="flex flex-col space-y-1.5">
                <Label for="framework">Framework</Label>
                <Select>
                  <SelectTrigger id="framework">
                    <SelectValue placeholder="Select" />
                  </SelectTrigger>
                  <SelectContent position="popper">
                    <SelectItem value="nuxt"> Nuxt </SelectItem>
                    <SelectItem value="next"> Next.js </SelectItem>
                    <SelectItem value="sveltekit"> SvelteKit </SelectItem>
                    <SelectItem value="astro"> Astro </SelectItem>
                  </SelectContent>
                </Select>
              </div>
            </div>
          </form>
        </CardContent>
        <CardFooter class="flex justify-between px-6 pb-6">
          <Button variant="outline"> Cancel </Button>
          <Link :href="route('register')"><Button>Deploy</Button></Link>
        </CardFooter>
      </Card>
      <div>
        <p class="text-xs font-bold">This is a text.</p>
        <p class="text-sm font-bold">This is a text.</p>
        <p class="text-base font-bold">This is a text.</p>
        <p class="text-lg font-bold">This is a text.</p>
        <p class="text-xl font-bold">This is a text.</p>
        <p class="text-2xl font-bold">This is a text.</p>
        <p class="text-3xl font-bold">This is a text.</p>
        <p class="text-4xl font-bold">This is a text.</p>
        <p class="text-5xl font-bold">This is a text.</p>
      </div>
    </div>
  </MaxWidthWrapper>
</template>
