<script setup>
import Head from '@/Partials/Head.vue'
import Layout from '@/Layouts/Main.vue'
import Prose from '@/Partials/Prose.vue'

defineProps({
  about: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <Head
    type="website"
    title="À propos"
    description="Et si on parlait un peu de moi ?"
  />
  <Layout>
    <Prose>
      <div v-html="about.value" />
    </Prose>
  </Layout>
</template>
