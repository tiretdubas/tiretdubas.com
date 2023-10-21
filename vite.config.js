import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import eslint from 'vite-plugin-eslint'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',
        'resources/css/app.css'
      ],
      ssr: 'resources/js/ssr.js',
      refresh: true
    }),
    vue(),
    eslint({
      fix: true,
      exclude: [
        '**/node_modules/**',
        '**/vendor/**'
      ]
    })
  ],
  resolve: {
    alias: {
      ziggy: 'vendor/tightenco/ziggy/dist/vue.es.js',
      '@resources': 'resources'
    }
  }
})
