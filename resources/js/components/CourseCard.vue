<script setup lang="ts">
import { AspectRatio } from './ui/aspect-ratio'
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
  <div className="w-72">
    <AspectRatio :ratio="7 / 3" class="rounded-xl bg-muted">
      <img
        src="https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80"
        alt="Photo by Drew Beamer"
        class="h-full w-full rounded-t-xl border-x border-t object-cover"
      />
    </AspectRatio>
    <div class="w-full rounded-b-xl border-x border-b p-4">
      <h3 class="text-md font-semibold">Cybersecurity 2</h3>
    </div>
  </div>
</template>
