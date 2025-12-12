<template>
  <div class="vista-dashboard">
    <h1 class="text-2xl font-bold mb-4">Vista Scheduler Dashboard</h1>
    <!-- Task list component -->
    <TaskList :tasks="tasks" @refresh="fetchTasks" />
  </div>
</template>

<script setup>
/**
 * App.vue
 *
 * Root component for the Vista dashboard. Responsible for fetching task data
 * from the Laravel backend API and passing it down to child components.
 *
 * Polls the API periodically to keep the UI updated.
 */

import { ref, onMounted } from 'vue'
import TaskList from './components/TaskList.vue'

const tasks = ref([])

/**
 * Fetch tasks from the backend API.
 */
async function fetchTasks() {
  const res = await fetch('/vista/api/tasks')
  const data = await res.json()

  // Merge registry and status into a unified task object
  tasks.value = Object.entries(data.registry).map(([id, json]) => {
    return {
      id,
      ...JSON.parse(json),
      status: JSON.parse(data.status[id] || '{}')
    }
  })
}

onMounted(() => {
  fetchTasks()
  // Poll every 10 seconds
  setInterval(fetchTasks, 10000)
})
</script>

<style scoped>
.vista-dashboard {
  padding: 1rem;
}
</style>
