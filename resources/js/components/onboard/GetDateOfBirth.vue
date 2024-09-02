<script setup lang="ts">
import { Button } from '../ui/button'
import { Label } from '@/components/ui/label'
import { Calendar } from '@/components/ui/calendar'
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

// Define props with the FormData interface and errors type
defineProps<{
  form: FormData
  errors: FormErrors
}>()

const df = new DateFormatter('en-US', {
  dateStyle: 'long',
})

const value = ref<DateValue>()
</script>

<template>
  <div class="mx-auto w-full max-w-lg md:max-w-[500px]">
    <div class="space-y-1">
      <Label>Enter your date of birth</Label>
      <Popover>
        <PopoverTrigger as-child>
          <Button
            variant="outline"
            :class="
              cn(
                'w-full justify-start text-left font-normal',
                !value && 'text-muted-foreground',
              )
            "
          >
            <CalendarIcon class="mr-2 h-4 w-4" />
            {{
              value
                ? df.format(value.toDate(getLocalTimeZone()))
                : 'Pick a date'
            }}
          </Button>
        </PopoverTrigger>
        <PopoverContent class="w-auto p-0">
          <Calendar v-model="value" initial-focus />
        </PopoverContent>
      </Popover>
    </div>
  </div>
</template>
