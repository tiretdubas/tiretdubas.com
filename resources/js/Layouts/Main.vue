<script setup>
import { inject, ref } from 'vue'
import { Link, usePage as page } from '@inertiajs/vue3'
import {
  Dialog,
  DialogPanel,
  TransitionRoot,
  TransitionChild
} from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/solid'

const route = inject('route')

const menuItems = [
  { text: 'Articles', href: route('posts.index'), match: page().component.startsWith('Post') },
  { text: 'Projets', href: route('projects'), match: page().component === 'Project' },
  { text: 'À propos', href: route('about'), match: page().component === 'About' }
]

const isOpen = ref(false)

function setIsOpen (value) {
  isOpen.value = value
}
</script>

<template>
  <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8 lg:py-16">
    <header class="flex justify-end">
      <button
        class="lg:hidden"
        @click="setIsOpen(true)"
      >
        <Bars3Icon class="h-8 w-8 text-slate-950 dark:text-slate-50" />
      </button>
      <TransitionRoot
        :show="isOpen"
        as="template"
        class="lg:hidden"
      >
        <Dialog
          class="fixed z-50"
          @close="setIsOpen"
        >
          <TransitionChild
            enter="duration-150 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-100 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
            as="template"
          >
            <div class="fixed inset-0 bg-black/70 backdrop-blur-sm dark:bg-black/50" />
          </TransitionChild>
          <div class="fixed inset-0">
            <TransitionChild
              enter="duration-150 ease-out"
              enter-from="opacity-0 scale-75"
              enter-to="opacity-100 scale-100"
              leave="duration-100 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-75"
              as="template"
            >
              <DialogPanel class="p-4">
                <div class="flex flex-col rounded-3xl bg-white p-8 dark:bg-slate-900 dark:ring-1 dark:ring-slate-800">
                  <button
                    class="self-end"
                    @click="setIsOpen(false)"
                  >
                    <XMarkIcon class="h-6 w-6 text-slate-500" />
                  </button>
                  <nav>
                    <ul class="divide-y divide-slate-200 text-lg text-slate-950 dark:divide-slate-800 dark:text-slate-50">
                      <li
                        v-for="menu_item in menuItems"
                        :key="menu_item.text"
                      >
                        <Link
                          :href="menu_item.href"
                          class="block py-2"
                        >
                          {{ menu_item.text }}
                        </Link>
                      </li>
                    </ul>
                  </nav>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </Dialog>
      </TransitionRoot>

      <nav>
        <ul class="hidden space-x-10 text-lg lg:flex">
          <li
            v-for="menu_item in menuItems"
            :key="menu_item.text"
          >
            <Link
              :href="menu_item.href"
              :class="{
                'font-semibold text-slate-950 underline dark:text-slate-50': menu_item.match,
                'text-slate-800 hover:underline dark:text-slate-200': ! menu_item.match
              }"
            >
              {{ menu_item.text }}
            </Link>
          </li>
        </ul>
      </nav>
    </header>
    <main class="mt-10 lg:mt-24">
      <slot />
    </main>
  </div>
</template>
