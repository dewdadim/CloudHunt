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
import type { FormData, FormErrors } from '@/Pages/Onboard.vue'
import { cn } from '@/lib/utils'
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

const value = ref<DateValue>()

props.form.date_of_birth = value.value?.toString()!
</script>

<template>
  <div class="mx-auto w-full max-w-lg md:max-w-[500px]">
    <div class="space-y-1">
      <!-- <Label>Enter your date of birth</Label> -->
      <!-- <FormInput
        name="Enter date of birth"
        placeholder="Pick a date"
        :message="errors.date_of_birth as string"
        v-model="form.date_of_birth"
      /> -->
      <Popover>
        <PopoverTrigger as-child>
          <Input v-model="form.date_of_birth as string" />
          <!-- <CalendarIcon class="mr-2 h-4 w-4" />
            {{
              value
                ? df.format(value.toDate(getLocalTimeZone()))
                : 'Pick a date'
            }} -->
        </PopoverTrigger>
        <small class="text-destructive" v-if="errors.date_of_birth">{{
          errors.date_of_birth
        }}</small>

        <PopoverContent class="w-auto p-0">
          <Calender v-model="value" initial-focus />
        </PopoverContent>
      </Popover>
    </div>
  </div>
</template>
