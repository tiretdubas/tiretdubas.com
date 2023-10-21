<script setup>
import { onMounted, ref } from 'vue'

const props = defineProps({
  value: {
    type: Object,
    required: true
  }
})

const isTruthy = ref(false)

onMounted(() => {
  isTruthy.value = Boolean(props.value)
})
</script>

<template>
  <template v-if="isTruthy">
    <slot />
  </template>
</template>
