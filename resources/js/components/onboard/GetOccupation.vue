<script setup lang="ts">
import { defineProps } from 'vue'
import type { FormErrors } from '@/Pages/Onboard.vue'
import { RadioGroup, RadioGroupItemCard } from '@/components/ui/radio-group'

// Define props with the FormData interface and errors type
defineProps<{
  form: Onboard
  errors: FormErrors
}>()
</script>

<template>
  <div class="mx-auto grid w-full max-w-lg gap-4 md:max-w-[500px]">
    <RadioGroup defaultValue="{null}" v-model="form.occupation">
      <div className="grid gap-3">
        <RadioGroupItemCard id="Software Engineer" class="justify-start">
          <div class="flex">
            <h4 class="text-lg font-semibold">👨‍💻 Software Engineer</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="IT Staff" class="justify-start">
          <div class="flex">
            <h4 class="text-lg font-semibold">👨🏻‍🔧 IT Staff</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Student">
          <div class="flex">
            <h4 class="text-lg font-semibold">🎓 Student</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Lecturer">
          <div class="flex">
            <h4 class="text-lg font-semibold">👨🏻‍🏫 Lecturer/Teacher</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Freelancer">
          <div class="flex">
            <h4 class="text-lg font-semibold">🤸🏻 Freelancer</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Others">
          <div class="flex">
            <h4 class="text-lg font-semibold">👥 Others...</h4>
          </div>
        </RadioGroupItemCard>
      </div>
    </RadioGroup>
    <small class="text-destructive" v-if="errors.occupation">{{
      errors.occupation
    }}</small>
  </div>
</template>
