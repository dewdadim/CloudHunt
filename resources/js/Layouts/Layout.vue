<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import Navbar from '@/components/Navbar.vue'
</script>

<template>
  <Navbar />
  <MaxWidthWrapper class="">
    <slot />
  </MaxWidthWrapper>
</template>
