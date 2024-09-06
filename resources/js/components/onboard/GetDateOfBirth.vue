<script setup lang="ts">
import { Button } from '../ui/button'
import { Label } from '@/components/ui/label'
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/ui/popover'
import { Calendar as CalendarIcon } from 'lucide-vue-next'
import { Calendar2 } from '@/components/ui/calendar'

import type { FormErrors } from '@/Pages/Onboard.vue'
import { DateFormatter, getLocalTimeZone } from '@internationalized/date'
import { cn } from '@/lib/utils'

// Define props with the FormData interface and errors type
defineProps<{
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
      <Label>Date Of Birth</Label>
      <Popover :modal="true">
        <PopoverTrigger as-child>
          <Button
            variant="secondary"
            :class="
              cn(
                'w-full justify-start',
                errors.date_of_birth ? 'border-destructive' : '',
              )
            "
          >
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

        <PopoverContent class="w-auto p-0" align="start">
          <Calendar2 v-model="form.date_of_birth" initial-focus />
        </PopoverContent>
      </Popover>
    </div>
  </div>
</template>
