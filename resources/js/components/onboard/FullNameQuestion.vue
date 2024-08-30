<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Button } from '../ui/button'
import FormInput from '../FormInput.vue'
import {
  ArrowLeft,
  Calendar as CalendarIcon,
  ChevronLeft,
} from 'lucide-vue-next'
import { Calendar } from '@/components/ui/calendar'
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/ui/popover'

import { cn } from '@/lib/utils'
import { ref } from 'vue'
import {
  DateFormatter,
  type DateValue,
  getLocalTimeZone,
} from '@internationalized/date'
import { useForm } from '@inertiajs/vue3'

const df = new DateFormatter('en-US', {
  dateStyle: 'long',
})

const value = ref<DateValue>()

const form = useForm({
  username: null,
  email: null,
  password: null,
})

const submit = () => {
  form.post(route('signup'), {
    replace: true,
  })
}
</script>

<template>
  <div class="mx-auto w-full max-w-lg md:max-w-[500px]">
    <!-- <div class="mb-3 flex gap-1">
      <Progress v-model="progress" class="my-2 shadow-taper" />
      <Progress :model-value="0" class="my-2 shadow-taper" />
      <Progress :model-value="0" class="my-2 shadow-taper" />
    </div> -->
    <!-- <Card class="mb-2 w-full">
      <CardHeader>
        <CardTitle>How can we call you?</CardTitle>
      </CardHeader>
    </Card> -->
    <Card class="w-full">
      <CardHeader class="items-center text-center">
        <CardTitle>How can we call you?</CardTitle>
        <CardDescription>
          Nice meet you! Let us know your name.
        </CardDescription>
      </CardHeader>
      <CardContent>
        <form class="grid gap-4">
          <FormInput
            name="Enter your name"
            placeholder="e.g. Nadim Hairi"
            v-model="form.password"
            :message="form.errors.password"
          />
          <!-- <Popover>
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
          </Popover> -->
        </form>
      </CardContent>
      <CardFooter class="flex justify-between">
        <Button variant="secondary">
          <ArrowLeft class="mr-2" :size="20" />
          Back
        </Button>
        <Button type="submit" class="" :disabled="form.processing">
          <Loader2 v-if="form.processing" class="mr-2 animate-spin" />
          Continue
        </Button>
      </CardFooter>
    </Card>
  </div>
</template>
