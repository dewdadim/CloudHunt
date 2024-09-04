<script setup lang="ts">
import { Button } from '../ui/button'
import { Label } from '@/components/ui/label'
// import { Calendar } from '@/components/ui/calendar'
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/ui/popover'
import { Calendar as CalendarIcon } from 'lucide-vue-next'

import { defineProps } from 'vue'
import type { FormErrors } from '@/Pages/Onboard.vue'
import { ref } from 'vue'
import {
  DateFormatter,
  type DateValue,
  getLocalTimeZone,
} from '@internationalized/date'
import Calender from './Calender.vue'
import FormInput from '../FormInput.vue'
import { Input } from '../ui/input'

// Define props with the FormData interface and errors type
const props = defineProps<{
  form: Onboard
  errors: FormErrors
}>()

const df = new DateFormatter('en-UK', {
  dateStyle: 'long',
})
</script>

<template>
  <div class="mx-auto w-full max-w-lg md:max-w-[500px]">
    <div class="space-y-1">
      <Label>Enter your birthday</Label>
      {{ new Date(form.date_of_birth) }}
      <Popover :modal="true">
        <PopoverTrigger as-child>
          <Button variant="secondary" class="w-full justify-start">
            <CalendarIcon class="mr-2 h-4 w-4" />
            {{
              form.date_of_birth
                ? df.format(form.date_of_birth.toDate(getLocalTimeZone()))
                : 'Pick a date'
            }}
          </Button>
        </PopoverTrigger>
        <small class="text-destructive" v-if="errors.date_of_birth">{{
          errors.date_of_birth
        }}</small>

        <PopoverContent class="w-auto p-0">
          <Calender v-model="form.date_of_birth" initial-focus />
        </PopoverContent>
      </Popover>
    </div>
  </div>
</template>
