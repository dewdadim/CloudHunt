<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import Navbar from '@/components/Navbar.vue'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()

const auth = computed(() => page.props.auth.user)
</script>

<template>
  <Navbar :auth="auth" />
  <MaxWidthWrapper>
    <slot />
  </MaxWidthWrapper>
</template>
