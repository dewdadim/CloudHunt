<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import {
  Card,
  CardContent,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Progress } from '@/components/ui/progress'
import { ChevronLeft, Loader2 } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'

import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import GetDateOfBirth from '@/components/onboard/GetDateOfBirth.vue'
import { cn } from '@/lib/utils'

import GetFullName from '@/components/onboard/GetFullName.vue'
import GetOccupation from '@/components/onboard/GetOccupation.vue'
import GetInterest from '@/components/onboard/GetInterest.vue'
import Complete from '@/components/onboard/Complete.vue'

export type FormErrors = Partial<Record<keyof Onboard, string | string[]>>

const { data } = defineProps<{
  data: {
    full_name: string
  }
}>()

const currentStep = ref(0)

// Calculate the progress percentage based on the current step
const progressPercentage = computed(() => {
  return ((currentStep.value + 1) / steps.length) * 100
})
const progress = ref(progressPercentage)

const form = useForm<Onboard>({
  full_name: data.full_name ?? undefined,
  prefer_name: undefined,
  // username: undefined,
  date_of_birth: undefined,
  occupation: undefined,
  interest: undefined,
})

const steps = [
  { title: 'What is your name?', form: GetFullName },
  { title: 'When is your birthday?', form: GetDateOfBirth },
  { title: 'What is your current occupation?', form: GetOccupation },
  { title: 'What is your interest?', form: GetInterest },
  {
    title: `All Set! Welcome ${form.prefer_name ?? 'to RunCloud Edu'}`,
    form: Complete,
  },
]

const validateCurrentStep = (): boolean => {
  let isValid = true
  const errors: FormErrors = {}

  switch (currentStep.value) {
    case 0:
      if (!form.full_name) {
        isValid = false
        errors.full_name = 'The full name field is required'
      }
      if (!form.prefer_name) {
        isValid = false
        errors.prefer_name = 'The preferred name field is required'
      }
      // if (!form.username) {
      //   isValid = false
      //   errors.username = 'The username field is required'
      // }

      if (form.prefer_name?.includes(' ')) {
        isValid = false
        errors.prefer_name = 'The preferred name can only be one word'
      }
      break

    case 1:
      if (!form.date_of_birth) {
        isValid = false
        errors.date_of_birth = 'The date of birth field is required'
      }
      break

    case 2:
      if (!form.occupation) {
        isValid = false
        errors.occupation = 'The occupation field is required'
      }
      break

    case 3:
      if (!form.interest) {
        isValid = false
        errors.interest = 'The interest field is required'
      }
      break
  }

  // Set the errors on the form object
  form.errors = errors as Partial<Record<keyof Onboard, string>>

  return isValid
}

const nextStep = async () => {
  const isValid = await validateCurrentStep()

  if (isValid && currentStep.value < steps.length - 1) {
    currentStep.value++
  }
}

const prevStep = () => {
  if (currentStep.value > 0) {
    currentStep.value--
  }
}

const handleKeyDown = (event: KeyboardEvent) => {
  if (event.key === 'Enter') {
    nextStep()
  }
}

onMounted(() => {
  window.addEventListener('keydown', handleKeyDown)
})

onBeforeUnmount(() => {
  window.removeEventListener('keydown', handleKeyDown)
})

const submit = () => {
  form.date_of_birth = new Date(form.date_of_birth).toISOString().split('T')[0]
  form.post(route('onboard'), {
    replace: true,
    onSuccess: () => {
      currentStep.value++
    },
  })
}
</script>

<template>
  <MaxWidthWrapper class="pt-10">
    <div class="flex items-center gap-4" v-if="currentStep < steps.length - 1">
      <ChevronLeft
        :class="
          cn(
            'flex-none',
            !currentStep ? 'cursor-not-allowed' : 'cursor-pointer',
          )
        "
        :size="28"
        @click="prevStep"
        :disabled="currentStep"
      />
      <Progress v-model="progress" class="w-6 grow" />
    </div>
    <main class="my-16 flex flex-col items-center gap-2">
      <Card class="mx-auto w-full max-w-lg md:max-w-[500px]">
        <CardHeader class="justify-center text-center">
          <CardTitle>
            {{ steps[currentStep].title }}
          </CardTitle>
        </CardHeader>
        <form @submit.prevent="submit">
          <CardContent v-auto-animate>
            <component
              :is="steps[currentStep].form"
              :form="form"
              :errors="form.errors"
            />
          </CardContent>
          <CardFooter
            :class="
              cn(
                'justify-end',
                currentStep == steps.length - 1 ? 'block w-full' : 'flex',
              )
            "
          >
            <Button
              type="button"
              @click="nextStep"
              v-if="currentStep < steps.length - 2"
            >
              Continue
            </Button>
            <Button
              type="submit"
              :disabled="form.processing"
              v-if="currentStep === steps.length - 2"
            >
              <Loader2 v-if="form.processing" class="mr-2 animate-spin" />
              Submit
            </Button>
            <Link
              :href="route('dashboard')"
              replace
              v-if="currentStep == steps.length - 1"
            >
              <Button class="w-full" size="lg">Continue Journey!</Button>
            </Link>
          </CardFooter>
        </form>
      </Card>
    </main>
  </MaxWidthWrapper>
</template>
