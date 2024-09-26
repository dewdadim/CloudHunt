<script setup lang="ts">
import { HTMLAttributes } from 'vue'
import { AspectRatio } from './ui/aspect-ratio'
import { cn } from '@/lib/utils'
import { Link } from '@inertiajs/vue3'

const props = defineProps<{
  class?: HTMLAttributes['class']
  courses?: Course[]
  title: string
  uri: string
}>()
</script>

<template>
  <!-- <Card class="shadow-0 p-0">
    <CardHeader class="p-2">
      <div className="w-64">
        <AspectRatio :ratio="3 / 2" class="rounded-xl bg-muted">
          <img
            src="https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80"
            alt="Photo by Drew Beamer"
            class="h-full w-full rounded-xl object-cover"
          />
        </AspectRatio>
      </div>
    </CardHeader>
    <CardContent class="p-2">
      <h3 class="text-xl font-semibold">Cybersecurity 2</h3>
    </CardContent>
    <CardFooter class="p-2">
      <Button variant="secondary" class="w-full">Continue Lesson</Button>
    </CardFooter>
  </Card> -->
  <div :className="cn('w-72', props.class)">
    <Link :href="route('courses.show', { id: props.uri })">
      <AspectRatio :ratio="7 / 3" class="rounded-xl bg-muted">
        <img
          src="https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80"
          alt="Photo by Drew Beamer"
          class="h-full w-full rounded-t-xl border-x border-t object-cover"
        />
      </AspectRatio>
      <div class="h-16 w-full rounded-b-xl border-x border-b px-3 py-1.5">
        <h3 class="text-md line-clamp-2 font-semibold">{{ props.title }}</h3>
      </div>
    </Link>
  </div>
</template>
