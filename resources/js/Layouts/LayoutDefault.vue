<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import Navbar from '@/components/Navbar.vue'
import { usePage } from '@inertiajs/vue3'

const auth = usePage().props.auth.user
</script>

<template>
  <Navbar :authUser="auth" />
  <MaxWidthWrapper>
    <slot />
  </MaxWidthWrapper>
</template>
