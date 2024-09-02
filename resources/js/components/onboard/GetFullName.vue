<script setup lang="ts">
import FormInput from '../FormInput.vue'
import { defineProps } from 'vue'
import type { FormData, FormErrors } from '@/Pages/Onboard.vue' // Import the FormData type

// Define props with the FormData interface and errors type
defineProps<{
  form: FormData
  errors: FormErrors
}>()
</script>

<template>
  <div class="mx-auto w-full max-w-lg md:max-w-[500px]">
    <FormInput
      name="Enter your name"
      placeholder="e.g. Nadim Hairi"
      v-model="form.full_name!"
      :message="errors.full_name as string"
    />
  </div>
</template>
