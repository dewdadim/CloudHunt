<script setup lang="ts">
  import { reactive } from 'vue'

  const add = (x: number, y: number) => {
    return x + y
  }

  const data = reactive({
    a: 0,
  })
</script>

<template>
  <h1 class="text-4xl font-bold">Home</h1>
  <p>{{ data . a }}</p>
  <button v-on:click="data.a = add(data.a, 2)">Add</button>
</template>
