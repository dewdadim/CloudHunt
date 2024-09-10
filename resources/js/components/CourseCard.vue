<script setup lang="ts">
import { AspectRatio } from './ui/aspect-ratio'
import { Card, CardContent, CardFooter, CardHeader } from './ui/card'
</script>

<template>
  <Card class="shadow-0 p-1">
    <CardContent class="p-0.5">
      <div className="w-64">
        <AspectRatio :ratio="3 / 2" class="rounded-xl bg-muted">
          <img
            src="https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?w=800&dpr=2&q=80"
            alt="Photo by Drew Beamer"
            class="h-full w-full rounded-xl object-cover"
          />
        </AspectRatio>
      </div>
    </CardContent>
    <CardFooter class="p-0.5 pt-2">
      <h3>Test test</h3>
    </CardFooter>
  </Card>
</template>
