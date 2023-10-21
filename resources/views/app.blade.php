<!DOCTYPE html>
<html class="antialiased" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#ffffff" />
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#111827" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <script>
      if (!['light', 'dark'].includes(localStorage.theme)) {
        localStorage.removeItem('theme')
      }

      if (localStorage.theme === 'dark' || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
      } else {
        document.documentElement.classList.remove('dark')
      }
    </script>
    @routes
    @vite([
      'resources/js/app.js',
      "resources/js/Pages/{$page['component']}.vue"
    ])
    @inertiaHead
  </head>
  <body class="dark:bg-gray-900">
    @inertia
  </body>
</html>
