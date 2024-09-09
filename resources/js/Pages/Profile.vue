<script setup lang="ts">
import MaxWidthWrapper from '@/components/MaxWidthWrapper.vue'
import { Card, CardHeader, CardTitle } from '@/components/ui/card'
import {
  DateFormatter,
  DateValue,
  getLocalTimeZone,
} from '@internationalized/date'

const { profile } = defineProps<{
  profile: {
    username: string
    prefer_name: string
    date_of_birth: string
  }
}>()

const df = new DateFormatter('en-UK', {
  dateStyle: 'long',
})
</script>

<template>
  <MaxWidthWrapper>
    <Card>
      <CardHeader>
        <CardTitle>{{ profile.prefer_name }}</CardTitle>
      </CardHeader>
    </Card>
  </MaxWidthWrapper>
</template>
