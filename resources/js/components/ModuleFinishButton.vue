<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Button } from './ui/button'

const props = defineProps<{
  lesson: Lesson
  module: Module
}>()
</script>

<template>
  <Button>
    <Link
      :href="
        route('modules.complete', {
          lesson: props.lesson.uri,
          module: module.uri,
        })
      "
      method="patch"
    >
      Finish
    </Link>
  </Button>
</template>
