<script setup lang="ts">
import { RadioGroup, RadioGroupItemCard } from '@/components/ui/radio-group'

const emit = defineEmits<{
  (e: 'response', data: TaskResponse): void
}>()

const handleQuestionAnswer = (answer: string) => {
  console.log(answer)
  if (answer === '2') {
    return emit('response', {
      canMoveNext: true,
      isCorrectAnswer: true,
    })
  }

  return emit('response', {
    canMoveNext: false,
    isCorrectAnswer: false,
  })
}
</script>
<template>
  <div class="space-y-10">
    <p class="text-xl font-semibold">
      What is the purpose of the
      <code class="rounded-lg bg-card/60 p-2 text-base font-normal">chmod</code>
      command in Linux?
    </p>
    <RadioGroup
      defaultValue="{null}"
      @update:model-value="handleQuestionAnswer"
    >
      <div class="grid gap-3">
        <RadioGroupItemCard id="1" class="justify-start">
          <div class="flex">
            <h4 class="text-lg font-semibold">To change file ownership</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="2" class="justify-start">
          <div class="flex">
            <h4 class="text-lg font-semibold">To change file permissions</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="3" class="justify-start">
          <div class="flex">
            <h4 class="text-lg font-semibold">To delete files</h4>
          </div>
        </RadioGroupItemCard>
        <RadioGroupItemCard id="4" class="justify-start">
          <div class="flex">
            <h4 class="text-lg font-semibold">To view file contents</h4>
          </div>
        </RadioGroupItemCard>
      </div>
    </RadioGroup>
  </div>
</template>
