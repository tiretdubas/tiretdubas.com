<script setup>
import { Link } from '@inertiajs/vue3'
import { ArrowLongRightIcon } from '@heroicons/vue/20/solid'
import Head from '@/Shared/Head.vue'
import Layout from '@/Layouts/Main.vue'
import Prose from '@/Shared/Prose.vue'
import ClientTruthyValue from '@/Shared/Client/TruthyValue.vue'

defineProps({
  catchblock: {
    type: Object,
    default: null
  },
  posts: {
    type: Array,
    required: true
  }
})
</script>

<template>
  <Head
    type="website"
    description="Parce qu’un long discours vaut mieux qu’un court silence"
  />
  <Layout>
    <ClientTruthyValue :value="catchblock">
      <Prose>
        <div v-html="catchblock.value" />
      </Prose>
    </ClientTruthyValue>
    <div class="mt-4 space-y-10 divide-y divide-slate-200 dark:divide-slate-800 md:space-y-14 lg:mt-12">
      <article
        v-for="post in posts"
        :key="post.id"
        class="space-y-5 pt-10 sm:space-y-6 md:pt-14"
      >
        <Link
          :href="route('posts.show', post)"
          class="group space-y-5 sm:space-y-6"
        >
          <h2 class="text-xl font-bold leading-tight text-slate-900 group-hover:underline dark:text-slate-100 sm:text-2xl">
            {{ post.title }}
          </h2>
          <p class="text-base leading-7 text-slate-700 dark:text-slate-300 sm:text-xl sm:leading-relaxed">
            {{ post.excerpt }}
          </p>
          <div class="flex items-center space-x-1 text-base font-semibold text-teal-500 group-hover:space-x-2 sm:space-x-2 sm:text-xl sm:group-hover:space-x-4">
            <span class="leading-none">Lire l'article</span>
            <ArrowLongRightIcon class="h-5 w-5 transition-all" />
          </div>
        </Link>
        <time
          :datetime="post.created_at"
          class="block text-sm text-slate-500 dark:text-slate-300 sm:text-base"
        >{{ post.created_at_for_muggles }}</time>
      </article>
    </div>
  </Layout>
</template>
