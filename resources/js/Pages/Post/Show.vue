<script setup>
import { Link } from '@inertiajs/vue3'
import { ArrowLeftCircleIcon } from '@heroicons/vue/24/outline'
import Head from '@/Partials/Head.vue'
import Layout from '@/Layouts/Main.vue'
import Prose from '@/Partials/Prose.vue'

defineProps({
  post: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <Head
    :title="post.title"
    type="article"
    :description="post.excerpt"
  >
    <meta
      property="article:published_time"
      :content="post.published_at"
    >
    <meta
      property="article:modified_time"
      :content="post.updated_at"
    >
    <meta
      property="article:author"
      content="Steven Sil"
    >
  </Head>
  <Layout>
    <div class="flex flex-col space-y-6 md:space-y-8">
      <Link
        :href="route('posts.index')"
        class="self-start text-slate-300 hover:text-slate-700 dark:text-slate-700 dark:hover:text-slate-300"
      >
        <ArrowLeftCircleIcon class="h-14 w-14" />
      </Link>
      <article>
        <time
          :datetime="post.published_at"
          class="block text-sm text-slate-500 dark:text-slate-300 sm:text-base"
        >{{ post.published_at_for_muggles }}</time>
        <Prose class="mt-2 md:mt-4">
          <h1>{{ post.title }}</h1>
          <div v-html="post.body" />
        </Prose>
      </article>
    </div>
  </Layout>
</template>
