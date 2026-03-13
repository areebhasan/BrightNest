<template>
    <AppPageLayout
      title="Children"
      eyebrow="Service Workspace"
      description="Manage children enrolled in this service."
    >
      <div v-if="loading" class="rounded-3xl border border-blue-100 bg-white shadow-sm p-6">
        Loading children...
      </div>
  
      <div v-else class="space-y-6">
        <div class="flex justify-end">
          <button
            class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700"
            @click="showCreateForm = !showCreateForm"
          >
            {{ showCreateForm ? 'Close' : 'Add Child' }}
          </button>
        </div>
  
        <div v-if="success" class="rounded-2xl border border-green-200 bg-green-50 p-4 text-green-700">
          {{ success }}
        </div>
  
        <div v-if="error" class="rounded-2xl border border-red-200 bg-red-50 p-4 text-red-700">
          {{ error }}
        </div>
  
        <div v-if="showCreateForm" class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm">
          <form class="space-y-4" @submit.prevent="createChild">
            <div>
              <label class="mb-1 block text-sm font-medium text-slate-700">CRN</label>
              <input
                v-model="form.crn"
                class="w-full rounded-2xl border border-slate-200 px-4 py-3"
              >
            </div>
  
            <div>
              <label class="mb-1 block text-sm font-medium text-slate-700">First Name</label>
              <input
                v-model="form.first_name"
                class="w-full rounded-2xl border border-slate-200 px-4 py-3"
              >
            </div>
  
            <div>
              <label class="mb-1 block text-sm font-medium text-slate-700">Last Name</label>
              <input
                v-model="form.last_name"
                class="w-full rounded-2xl border border-slate-200 px-4 py-3"
              >
            </div>
  
            <div>
              <label class="mb-1 block text-sm font-medium text-slate-700">Date of Birth</label>
              <input
                v-model="form.dob"
                type="date"
                class="w-full rounded-2xl border border-slate-200 px-4 py-3"
              >
            </div>
  
            <div class="flex gap-3">
              <button
                type="submit"
                class="rounded-2xl bg-blue-600 px-5 py-3 text-white hover:bg-blue-700"
              >
                Save Child
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
  
        <div
          v-if="children.length === 0"
          class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm"
        >
          No children added yet.
        </div>
  
        <div v-else class="grid grid-cols-1 gap-5 md:grid-cols-2">
          <div
            v-for="child in children"
            :key="child.id"
            class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm"
          >
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">
                        {{ child.first_name }} {{ child.last_name }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        CRN: {{ child.crn }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        DOB: {{ child.dob }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Age: {{ child.age_in_months }} months
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Room: {{ child.room_name || 'Not enrolled yet' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Suggested Room: {{ child.suggested_room_name || 'No suggestion' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Status: {{ child.status }}
                    </p>
                </div>
  
              <button
                type="button"
                class="rounded-2xl border border-red-200 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700 hover:bg-red-100"
                @click="deleteChild(child)"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </AppPageLayout>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue'
  import AppPageLayout from './AppPageLayout.vue'
  
  const children = ref([])
  const loading = ref(true)
  const error = ref('')
  const success = ref('')
  const showCreateForm = ref(false)
  
  const form = ref({
    crn: '',
    first_name: '',
    last_name: '',
    dob: '',
  })
  
  const loadChildren = async () => {
    try {
      loading.value = true
      error.value = ''
  
      const response = await fetch('/app/children-data', {
        headers: {
          Accept: 'application/json',
        },
      })
  
      if (!response.ok) {
        throw new Error('Failed to load children.')
      }
  
      children.value = await response.json()
    } catch (err) {
      error.value = err.message || 'Something went wrong.'
    } finally {
      loading.value = false
    }
  }
  
  const createChild = async () => {
    error.value = ''
    success.value = ''
  
    try {
      const token = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')
  
      const response = await fetch('/children', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token,
          Accept: 'application/json',
        },
        body: JSON.stringify(form.value),
      })
  
      const data = await response.json().catch(() => ({}))
  
      if (!response.ok) {
        throw new Error(data.message || 'Failed to create child.')
      }
  
      success.value = 'Child created successfully.'
      showCreateForm.value = false
      resetForm()
      await loadChildren()
    } catch (err) {
      error.value = err.message || 'Something went wrong.'
    }
  }
  
  const deleteChild = async (child) => {
    if (!window.confirm(`Delete ${child.first_name} ${child.last_name}?`)) return
  
    error.value = ''
    success.value = ''
  
    try {
      const token = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content')
  
      const response = await fetch(`/children/${child.id}`, {
        method: 'DELETE',
        headers: {
          Accept: 'application/json',
          'X-CSRF-TOKEN': token,
        },
      })
  
      const data = await response.json().catch(() => ({}))
  
      if (!response.ok) {
        throw new Error(data.message || 'Failed to delete child.')
      }
  
      success.value = 'Child deleted successfully.'
      await loadChildren()
    } catch (err) {
      error.value = err.message || 'Something went wrong.'
    }
  }
  
  const resetForm = () => {
    form.value = {
      crn: '',
      first_name: '',
      last_name: '',
      dob: '',
    }
  }
  
  onMounted(loadChildren)
  </script>