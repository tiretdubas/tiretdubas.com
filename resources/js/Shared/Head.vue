<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import logo from '@resources/img/logo.png'

const props = defineProps({
  title: {
    type: String,
    default: null
  },
  type: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  }
})

const app = usePage().props.app
const fullTitle = props.title ? `${props.title} | ${app.name}` : app.name
</script>

<template>
  <Head :title="fullTitle">
    <meta
      property="og:type"
      :content="type"
    >
    <meta
      property="og:title"
      :content="fullTitle"
    >
    <meta
      property="og:locale"
      :content="app.locale"
    >
    <meta
      property="og:image"
      :content="logo"
    >
    <meta
      property="og:image:alt"
      content="Un magnifique tiret noir sur fond jaune"
    >
    <meta
      property="og:description"
      :content="description"
    >
    <meta
      name="twitter:site"
      content="@_tiretdubas"
    >
    <meta
      name="twitter:creator"
      content="@stevensil_"
    >
    <slot />
  </Head>
</template>
