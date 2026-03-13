<template>
    <div class="py-8">
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div v-if="title" class="flex items-center justify-between">
          <div>
            <p v-if="eyebrow" class="text-xs font-semibold uppercase tracking-[0.22em] text-blue-600">
              {{ eyebrow }}
            </p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
              {{ title }}
            </h1>
            <p v-if="description" class="mt-2 text-sm text-slate-500">
              {{ description }}
            </p>
          </div>
  
          <div v-if="$slots.actions">
            <slot name="actions" />
          </div>
        </div>
  
        <slot />
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    title: {
      type: String,
      default: '',
    },
    eyebrow: {
      type: String,
      default: '',
    },
    description: {
      type: String,
      default: '',
    },
  })
  </script>