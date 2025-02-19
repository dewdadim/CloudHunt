<script setup lang="ts">
interface Course {
  id: number
  databaseId: number
  title: string
  slug: string
  uri: string
  date: Date
  modified: Date
  featuredImage: string
}

const props = defineProps<{
  courses: Course[]
}>()

console.log(props.courses)
</script>

<template>
  <div class="p-4">
    <h1 class="mb-4 text-2xl font-bold">Course List</h1>
    <ul class="space-y-4">
      <li
        v-for="course in props.courses"
        :key="course.id"
        class="flex items-center rounded-lg border p-4 shadow"
      >
        <img
          :src="course.featuredImage"
          alt="Featured Image"
          class="mr-4 h-16 w-16 rounded"
        />
        <span class="text-lg">{{ course.title }}</span>
      </li>
    </ul>
  </div>
</template>
