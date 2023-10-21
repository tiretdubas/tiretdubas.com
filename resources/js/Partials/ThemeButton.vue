<script setup>
import { onMounted, ref, watch } from 'vue'
import { Switch } from '@headlessui/vue'
import {
  MoonIcon,
  SunIcon
} from '@heroicons/vue/20/solid'

const loaded = ref(false)
const lumos = ref(false)

onMounted(() => {
  if (!document.documentElement.classList.contains('dark')) {
    lumos.value = true
  }

  watch(lumos, async () => {
    localStorage.theme = (lumos.value ? 'light' : 'dark')
    if (localStorage.theme === 'dark') {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }
  })

  loaded.value = true
})
</script>

<template>
  <Switch v-if="loaded" v-model="lumos" :class="[lumos ? 'bg-yellow-600' : 'bg-gray-600', 'relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none']">
    <span class="sr-only">Changer le thème</span>
    <span :class="[lumos ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transition duration-200 ease-in-out']">
      <span :class="[lumos ? 'opacity-0 duration-100 ease-out' : 'opacity-100 duration-200 ease-in', 'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity']" aria-hidden="true">
        <MoonIcon class="h-4 w-4 text-gray-700" />
      </span>
      <span :class="[lumos ? 'opacity-100 duration-200 ease-in' : 'opacity-0 duration-100 ease-out', 'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity']" aria-hidden="true">
        <SunIcon class="h-4 w-4 text-yellow-600" />
      </span>
    </span>
</Switch>
</template>
