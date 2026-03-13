<template>
    <AppPageLayout
      title="Rooms"
      eyebrow="Service Workspace"
      description="Manage rooms for your active service."
    >
      <div v-if="loading" class="rounded-3xl border border-blue-100 bg-white shadow-sm p-6">
        <p class="text-slate-600">Loading rooms...</p>
      </div>
  
      <div v-else class="space-y-6">
        <div class="flex justify-end">
          <button
            class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            @click="showCreateForm = !showCreateForm"
          >
            {{ showCreateForm ? 'Close' : 'Add Room' }}
          </button>
        </div>
  
        <div v-if="success" class="rounded-2xl border border-green-200 bg-green-50 p-4 text-green-700">
          {{ success }}
        </div>
  
        <div v-if="error" class="rounded-2xl border border-red-200 bg-red-50 p-4 text-red-700">
          {{ error }}
        </div>
  
        <div v-if="showCreateForm" class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm">
          <h3 class="mb-4 text-lg font-semibold text-slate-900">Create Room</h3>
  
          <form class="space-y-4" @submit.prevent="createRoom">
            <div>
              <label class="mb-1 block text-sm font-medium text-slate-700">Room Name</label>
              <input
                v-model="form.name"
                type="text"
                class="w-full rounded-2xl border px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                :class="validationErrors.name ? 'border-red-300' : 'border-slate-200'"
                required
              >
              <p v-if="validationErrors.name" class="mt-1 text-sm text-red-600">
                {{ validationErrors.name[0] }}
              </p>
            </div>
  
            <div>
              <label class="mb-1 block text-sm font-medium text-slate-700">Age Group</label>
              <input
                v-model="form.age_group"
                type="text"
                class="w-full rounded-2xl border px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                :class="validationErrors.age_group ? 'border-red-300' : 'border-slate-200'"
                placeholder="e.g. 2 to 3 years"
              >
              <p v-if="validationErrors.age_group" class="mt-1 text-sm text-red-600">
                {{ validationErrors.age_group[0] }}
              </p>
            </div>
  
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
              <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Min Age (Months)</label>
                <input
                  v-model="form.min_age_months"
                  type="number"
                  class="w-full rounded-2xl border px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                  :class="validationErrors.min_age_months ? 'border-red-300' : 'border-slate-200'"
                  placeholder="e.g. 24"
                >
                <p v-if="validationErrors.min_age_months" class="mt-1 text-sm text-red-600">
                  {{ validationErrors.min_age_months[0] }}
                </p>
              </div>
  
              <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Max Age (Months)</label>
                <input
                  v-model="form.max_age_months"
                  type="number"
                  class="w-full rounded-2xl border px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                  :class="validationErrors.max_age_months ? 'border-red-300' : 'border-slate-200'"
                  placeholder="e.g. 36"
                >
                <p v-if="validationErrors.max_age_months" class="mt-1 text-sm text-red-600">
                  {{ validationErrors.max_age_months[0] }}
                </p>
              </div>
            </div>
  
            <div>
              <label class="mb-1 block text-sm font-medium text-slate-700">Status</label>
              <select
                v-model="form.status"
                class="w-full rounded-2xl border px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                :class="validationErrors.status ? 'border-red-300' : 'border-slate-200'"
              >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
              <p v-if="validationErrors.status" class="mt-1 text-sm text-red-600">
                {{ validationErrors.status[0] }}
              </p>
            </div>
  
            <div class="flex gap-3">
              <button
                type="submit"
                class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700"
              >
                Save Room
              </button>
  
              <button
                type="button"
                class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                @click="resetForm"
              >
                Reset
              </button>
            </div>
          </form>
        </div>
  
        <div v-if="rooms.length === 0" class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm">
          <p class="text-slate-600">No rooms added yet.</p>
        </div>
  
        <div v-else class="grid grid-cols-1 gap-5 md:grid-cols-2">
          <div
            v-for="room in rooms"
            :key="room.id"
            class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm"
          >
            <div class="flex items-start justify-between gap-4">
              <div>
                <h3 class="text-xl font-bold text-slate-900">{{ room.name }}</h3>
  
                <p class="mt-2 text-sm text-slate-500">
                  Age Group: {{ room.age_group || 'Not set' }}
                </p>
  
                <p class="mt-1 text-sm text-slate-500">
                  Age Range: {{ room.min_age_months || 'N/A' }} to {{ room.max_age_months || 'N/A' }} months
                </p>
  
                <p class="mt-1 text-sm text-slate-500">
                  Status: {{ room.status }}
                </p>
              </div>
  
              <div class="flex shrink-0 items-center gap-3">
                <div
                  class="rounded-2xl px-3 py-1 text-xs font-semibold uppercase tracking-wide"
                  :class="room.status === 'active'
                    ? 'border border-blue-100 bg-blue-50 text-blue-700'
                    : 'border border-slate-200 bg-slate-100 text-slate-600'"
                >
                  {{ room.status }}
                </div>
  
                <button
                  type="button"
                  class="rounded-2xl border border-red-200 bg-red-50 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-red-700 hover:bg-red-100"
                  @click="deleteRoom(room)"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AppPageLayout>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue'
  import AppPageLayout from './AppPageLayout.vue'
  
  const rooms = ref([])
  const loading = ref(true)
  const error = ref('')
  const success = ref('')
  const validationErrors = ref({})
  const showCreateForm = ref(false)
  
  const form = ref({
    name: '',
    age_group: '',
    min_age_months: '',
    max_age_months: '',
    status: 'active',
  })
  
  const loadRooms = async () => {
    try {
      loading.value = true
      error.value = ''
  
      const response = await fetch('/app/rooms-data', {
        headers: {
          Accept: 'application/json',
        },
      })
  
      if (!response.ok) {
        throw new Error('Failed to load rooms.')
      }
  
      rooms.value = await response.json()
    } catch (err) {
      error.value = err.message || 'Something went wrong.'
    } finally {
      loading.value = false
    }
  }
  
  const createRoom = async () => {
    error.value = ''
    success.value = ''
    validationErrors.value = {}
  
    try {
      const token = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')
  
      const response = await fetch('/rooms', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify(form.value),
      })
  
      const data = await response.json().catch(() => ({}))
  
      if (response.status === 422) {
        validationErrors.value = data.errors || {}
        throw new Error('Please fix the highlighted fields.')
      }
  
      if (!response.ok) {
        throw new Error(data.message || 'Failed to create room.')
      }
  
      success.value = 'Room created successfully.'
      resetForm()
      showCreateForm.value = false
      await loadRooms()
    } catch (err) {
      error.value = err.message || 'Something went wrong.'
    }
  }
  
  const resetForm = () => {
    form.value = {
      name: '',
      age_group: '',
      min_age_months: '',
      max_age_months: '',
      status: 'active',
    }
    validationErrors.value = {}
  }
  
  const deleteRoom = async (room) => {
    const confirmed = window.confirm(
      `Delete ${room.name}? This may also remove linked enrolments and attendance records.`
    )
  
    if (!confirmed) return
  
    error.value = ''
    success.value = ''
  
    try {
      const token = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')
  
      const response = await fetch(`/rooms/${room.id}`, {
        method: 'DELETE',
        headers: {
          Accept: 'application/json',
          'X-CSRF-TOKEN': token,
        },
      })
  
      const data = await response.json().catch(() => ({}))
  
      if (!response.ok) {
        throw new Error(data.message || 'Failed to delete room.')
      }
  
      success.value = 'Room deleted successfully.'
      await loadRooms()
    } catch (err) {
      error.value = err.message || 'Something went wrong.'
    }
  }
  
  onMounted(loadRooms)
  </script>