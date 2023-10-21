<script setup>
import { CodeBracketSquareIcon } from '@heroicons/vue/24/outline'
import { LinkIcon } from '@heroicons/vue/20/solid'
import Head from '@/Partials/Head.vue'
import Layout from '@/Layouts/Main.vue'
import ClientTruthyValue from '@/Partials/Client/TruthyValue.vue'
import Prose from '@/Partials/Prose.vue'

defineProps({
  catchblock: {
    type: Object,
    default: null
  },
  projects: {
    type: Array,
    required: true
  }
})
</script>

<template>
  <Head
    type="website"
    title="Projets"
    description="Quelques petites choses qu’on appelle « side-projects »"
  />
  <Layout>
    <ClientTruthyValue :value="catchblock">
      <Prose>
        <div v-html="catchblock.value" />
      </Prose>
    </ClientTruthyValue>
    <ul class="mt-8 grid gap-6 lg:mt-16 lg:grid-cols-2">
      <li
        v-for="project in projects"
        :key="project.id"
      >
        <a
          :href="project.url"
          target="_blank"
          class="group flex h-full flex-col rounded-2xl border border-slate-100 p-6 hover:border-slate-50 hover:bg-slate-50 dark:border-slate-800 dark:hover:border-slate-950 dark:hover:bg-slate-950"
        >
          <div class="mb-auto flex items-center text-slate-900 dark:text-slate-100">
            <img
              v-if="project.icon"
              :src="`/storage/${project.icon}`"
              class="h-12 w-12 rounded-lg"
              :alt="project.alt"
            >
            <CodeBracketSquareIcon
              v-else
              class="h-12 w-12"
            />
            <h2 class="ml-3 text-xl font-bold leading-tight text-slate-900 dark:text-slate-100 sm:text-2xl">{{ project.name }}</h2>
          </div>
          <p class="my-8 text-base leading-7 text-slate-700 dark:text-slate-300 sm:my-10 sm:text-lg sm:leading-relaxed">{{ project.description }}</p>
          <div class="mt-auto flex items-center text-teal-500">
            <LinkIcon class="h-5 w-5" />
            <span
              class="ml-2 font-semibold leading-none group-hover:underline"
              :href="project.url"
              target="_blank"
            >{{ project.label }}</span>
          </div>
        </a>
      </li>
    </ul>
  </Layout>
</template>
