<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import Navbar from '@/components/Navbar.vue'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
interface User {
  avatar: string
  name: string
}

const user = computed(() => page.props.auth.user)
</script>

<template>
  <Navbar
    :avatar="user.avatar!"
    :prefer_name="user.prefer_name"
    :username="user.username"
  />
  <MaxWidthWrapper class="">
    <slot />
  </MaxWidthWrapper>
</template>
