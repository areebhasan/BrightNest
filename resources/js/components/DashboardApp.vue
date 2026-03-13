import AppPageLayout from './AppPageLayout.vue'

<template>
    <AppPageLayout
      title="Dashboard"
      eyebrow="Service Workspace"
      description="A quick overview of your selected service."
    >
      <div v-if="loading" class="rounded-3xl border border-blue-100 bg-white shadow-sm p-6">
        <p class="text-slate-600">Loading dashboard...</p>
      </div>
  
      <div v-else-if="error" class="rounded-3xl border border-red-200 bg-white shadow-sm p-6">
        <p class="text-red-600">{{ error }}</p>
      </div>
  
      <template v-else>
        <section class="rounded-3xl bg-blue-700 shadow-xl overflow-hidden">
          <div class="px-8 py-8 md:px-10 md:py-10">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-blue-100">
              Active Service
            </p>
  
            <h1 class="mt-3 text-3xl md:text-4xl font-bold text-white">
              {{ dashboard.service.service_name }}
            </h1>
  
            <p class="mt-3 text-base text-blue-100 max-w-2xl">
              Manage rooms, enrolments, staff, and daily attendance for your selected centre.
            </p>
  
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
              <div class="rounded-2xl bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                  Provider
                </p>
                <p class="mt-2 text-base font-semibold text-slate-900">
                  {{ dashboard.service.provider_name || 'Not set' }}
                </p>
              </div>
  
              <div class="rounded-2xl bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                  Daily Fee
                </p>
                <p class="mt-2 text-base font-semibold text-slate-900">
                  ${{ Number(dashboard.service.daily_fee).toFixed(2) }}
                </p>
              </div>
  
              <div class="rounded-2xl bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                  Workspace
                </p>
                <p class="mt-2 text-base font-semibold text-slate-900">
                  Operational
                </p>
              </div>
            </div>
          </div>
        </section>
  
        <section class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
          <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
              <div>
                <p class="text-sm font-medium text-slate-500">Total Rooms</p>
                <h3 class="mt-4 text-3xl font-bold text-slate-900">
                  {{ dashboard.stats.total_rooms }}
                </h3>
              </div>
              <div class="h-12 w-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-700 font-bold">
                R
              </div>
            </div>
          </div>
  
          <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
              <div>
                <p class="text-sm font-medium text-slate-500">Total Children</p>
                <h3 class="mt-4 text-3xl font-bold text-slate-900">
                  {{ dashboard.stats.total_children }}
                </h3>
              </div>
              <div class="h-12 w-12 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-700 font-bold">
                C
              </div>
            </div>
          </div>
  
          <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
              <div>
                <p class="text-sm font-medium text-slate-500">Active Enrolments</p>
                <h3 class="mt-4 text-3xl font-bold text-slate-900">
                  {{ dashboard.stats.active_enrolments }}
                </h3>
              </div>
              <div class="h-12 w-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                E
              </div>
            </div>
          </div>
  
          <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
              <div>
                <p class="text-sm font-medium text-slate-500">Today's Attendance</p>
                <h3 class="mt-4 text-3xl font-bold text-slate-900">
                  {{ dashboard.stats.today_attendance }}
                </h3>
              </div>
              <div class="h-12 w-12 rounded-2xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-cyan-700 font-bold">
                A
              </div>
            </div>
          </div>
        </section>
      </template>
    </AppPageLayout>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue'
  import AppPageLayout from './AppPageLayout.vue'
  
  const dashboard = ref(null)
  const loading = ref(true)
  const error = ref('')
  
  onMounted(async () => {
    try {
      const response = await fetch('/app/dashboard-data', {
        headers: {
          Accept: 'application/json',
        },
      })
  
      if (!response.ok) {
        throw new Error('Failed to load dashboard data.')
      }
  
      dashboard.value = await response.json()
    } catch (err) {
      error.value = err.message || 'Something went wrong.'
    } finally {
      loading.value = false
    }
  })
  </script>