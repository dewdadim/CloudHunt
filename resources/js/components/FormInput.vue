<script setup lang="ts">
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'

const model = defineModel({
  type: null,
  required: true,
})

defineProps<{
  name: string
  placeholder: string
  type?: string
  message?: string
  required?: boolean
}>()
</script>

<template>
  <div class="space-y-1">
    <Label :for="name">{{ name }}</Label>
    <Input
      :id="name"
      v-model="model as any"
      :type="type ?? 'text'"
      :placeholder="placeholder"
      :class="{ '!border-destructive': message }"
      :required="required ?? false"
    />
    <small class="text-destructive" v-if="message">{{ message }}</small>
  </div>
</template>
