<script setup lang="ts">
import type { FormErrors } from '@/Pages/Onboard/Onboard.vue'
import { RadioGroup, RadioGroupItemCard } from '@/components/ui/radio-group'

// Define props with the FormData interface and errors type
defineProps<{
  form: Onboard
  errors: FormErrors
}>()
</script>

<template>
  <div class="mx-auto grid w-full max-w-lg gap-4 md:max-w-[500px]">
    <RadioGroup defaultValue="{null}" v-model="form.interest">
      <div class="grid gap-3">
        <RadioGroupItemCard id="AI" class="justify-start">
          <div class="flex">
            <h4 class="text-lg font-semibold">🤖 AI & Machine Learning</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="IoT" class="justify-start">
          <div class="flex">
            <h4 class="text-lg font-semibold">📡 Internet of Things (IoT)</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Data Analaytic">
          <div class="flex">
            <h4 class="text-lg font-semibold">📊 Data Analytics</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Game Dev">
          <div class="flex">
            <h4 class="text-lg font-semibold">🎮 Game Development</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="App Dev">
          <div class="flex">
            <h4 class="text-lg font-semibold">📱 Web/App Development</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Networking">
          <div class="flex">
            <h4 class="text-lg font-semibold">🖇️ Networking</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Cybersecurity">
          <div class="flex">
            <h4 class="text-lg font-semibold">🔒 Cybersecurity</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="Others">
          <div class="flex">
            <h4 class="text-lg font-semibold">👥 Others...</h4>
          </div>
        </RadioGroupItemCard>
      </div>
    </RadioGroup>
    <small class="text-destructive" v-if="errors.interest">{{
      errors.interest
    }}</small>
  </div>
</template>
