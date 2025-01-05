<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Button } from './ui/button'
import { Loader2 } from 'lucide-vue-next'

const props = defineProps<{
  lesson: Lesson
  module: Module
}>()
</script>

<template>
  <Link
    class="flex w-full"
    :href="
      route('modules.complete', {
        lesson: props.lesson.uri,
        module: module.uri,
      })
    "
    method="patch"
    as="button"
  >
    <Button size="lg" disable-sound> Finish Lesson! </Button>
  </Link>
</template>
