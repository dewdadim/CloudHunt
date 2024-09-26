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
  <div :className="cn('w-72', props.class)">
    <Link
      :href="route('courses.show', { id: props.uri })"
      :data="{ chapter: 1 }"
    >
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
