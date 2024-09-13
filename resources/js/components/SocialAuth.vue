<script setup lang="ts">
import { Button } from './ui/button'
import { FcGoogle, CoGithub } from 'oh-vue-icons/icons'
import { OhVueIcon as Vicon, addIcons } from 'oh-vue-icons'

addIcons(FcGoogle)
addIcons(CoGithub)
</script>
<template>
  <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
    <a :href="route('auth.github')" target="_self">
      <Button variant="outline" class="w-full">
        <Vicon name="co-github" :scale="1.2" class="mr-2" />
        GitHub
      </Button>
    </a>
    <a :href="route('auth.google')" target="_self">
      <Button variant="outline" class="w-full">
        <Vicon name="fc-google" :scale="1.2" class="mr-2" />
        Google
      </Button>
    </a>
  </div>
</template>
