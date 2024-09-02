<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import GetFullName from '@/components/onboard/GetFullName.vue'
import {
  Card,
  CardContent,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Progress } from '@/components/ui/progress'
import { ChevronLeft } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'

import { ref, watchEffect } from 'vue'
import { useForm } from '@inertiajs/vue3'
import GetDateOfBirth from '@/components/onboard/GetDateOfBirth.vue'

export interface FormData {
  full_name: string
  date_of_birth: string
  occupation: string
}

const progress = ref(0)

watchEffect((cleanupFn) => {
  const timer = setTimeout(() => (progress.value = 25), 500)
  cleanupFn(() => clearTimeout(timer))
})

const currentStep = ref(0)

const form = useForm<FormData>({
  full_name: '',
  date_of_birth: '',
  occupation: '',
})

const steps = [
  { title: 'What is your name?', form: GetFullName },
  { title: 'When is your birthday?', form: GetDateOfBirth },
]

const validateCurrentStep = (): boolean => {
  let isValid = true
  const errors: FormErrors = {}

  if (currentStep.value === 0) {
    if (!form.full_name) {
      isValid = false
      errors.full_name = 'First name is required'
    }
    if (!form.full_name) {
      isValid = false
      errors.full_name = 'Last name is required'
    }
  } else if (currentStep.value === 1) {
    if (!form.date_of_birth) {
      isValid = false
      errors.date_of_birth = 'Email is required'
    } else if (!/\S+@\S+\.\S+/.test(form.date_of_birth)) {
      isValid = false
      errors.date_of_birth = 'Email is invalid'
    }
  }

  // Set the errors on the form object
  form.errors = errors

  return isValid
}

const nextStep = async () => {
  const isValid = await validateCurrentStep()

  if (isValid && currentStep.value < steps.length - 1) {
    currentStep.value++
  }
}

export type FormErrors = Partial<Record<keyof FormData, string | string[]>>

const prevStep = () => {
  if (currentStep.value > 0) {
    currentStep.value--
  }
}

const submit = () => {
  form.post(route('onboard'), {
    replace: true,
  })
}
</script>

<template>
  <MaxWidthWrapper class="h-screen pt-10">
    <div class="mb-16 flex items-center gap-4">
      <ChevronLeft class="flex-none" :size="28" v-on:click="" />
      <Progress v-model="progress" class="w-6 grow" />
    </div>
    <main class="flex flex-col items-center gap-2">
      <Card class="mx-auto w-full max-w-lg md:max-w-[500px]">
        <CardHeader class="justify-center text-center">
          <CardTitle>
            {{ steps[currentStep].title }}
          </CardTitle>
        </CardHeader>
        <form @submit.prevent="submit">
          <CardContent>
            <component
              :is="steps[currentStep].form"
              :form="form"
              :errors="form.errors"
            />
          </CardContent>
          <CardFooter class="flex justify-end">
            <Button
              type="button"
              @click="nextStep"
              v-if="currentStep < steps.length - 1"
            >
              Continue
            </Button>
            <Button
              type="submit"
              class=""
              :disabled="form.processing"
              v-if="currentStep === steps.length - 1"
            >
              <Loader2 v-if="form.processing" class="mr-2 animate-spin" />
              Submit
            </Button>
          </CardFooter>
        </form>
      </Card>
    </main>
  </MaxWidthWrapper>
</template>
