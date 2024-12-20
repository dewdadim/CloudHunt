<script setup lang="ts">
import FormInput from '../FormInput.vue'
import type { FormErrors } from '@/Pages/Onboard/Onboard.vue' // Import the FormData type

// Define props with the FormData interface and errors type
defineProps<{
  form: Onboard
  errors: FormErrors
}>()
</script>

<template>
  <div class="mx-auto grid w-full max-w-lg gap-4 md:max-w-[500px]">
    <FormInput
      name="Full Name"
      placeholder="e.g. John Doe"
      v-model="form.full_name"
      :message="errors.full_name?.toString()"
    />
    <FormInput
      name="Preffered Name"
      :placeholder="'e.g. ' + (form.full_name?.split(' ', 1) ?? 'John')"
      v-model="form.prefer_name"
      :message="errors.prefer_name?.toString()"
    />
    <!-- <FormInput
      name="Create Username"
      :placeholder="'e.g. john123'"
      v-model="form.username"
      :message="errors.username?.toString()"
    /> -->
  </div>
</template>
