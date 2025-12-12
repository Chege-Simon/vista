<template>
  <tr>
    <td class="border px-4 py-2">{{ task.command }}</td>
    <td class="border px-4 py-2">{{ task.expression }}</td>
    <td class="border px-4 py-2">
      <span :class="statusClass">{{ task.status.status || 'idle' }}</span>
    </td>
    <td class="border px-4 py-2">{{ task.status.pod || '-' }}</td>
    <td class="border px-4 py-2 space-x-2">
      <button class="btn" @click="run">Run</button>
      <button class="btn" @click="retry">Retry</button>
      <button v-if="task.enabled" class="btn" @click="disable">Disable</button>
      <button v-else class="btn" @click="enable">Enable</button>
    </td>
  </tr>
</template>

<script setup>
/**
 * TaskRow.vue
 *
 * Represents a single task row in the dashboard. Provides action buttons
 * to run, retry, enable, or disable the task via API calls.
 */

const props = defineProps({
  task: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['refresh'])

/**
 * Compute CSS class for status label.
 */
const statusClass = computed(() => {
  switch (props.task.status.status) {
    case 'running': return 'text-blue-600 font-semibold'
    case 'success': return 'text-green-600 font-semibold'
    case 'failed': return 'text-red-600 font-semibold'
    default: return 'text-gray-500'
  }
})

async function run() {
  await fetch(`/vista/api/tasks/${props.task.id}/run`, { method: 'POST' })
  emit('refresh')
}

async function retry() {
  await fetch(`/vista/api/tasks/${props.task.id}/retry`, { method: 'POST' })
  emit('refresh')
}

async function enable() {
  await fetch(`/vista/api/tasks/${props.task.id}/enable`, { method: 'POST' })
  emit('refresh')
}

async function disable() {
  await fetch(`/vista/api/tasks/${props.task.id}/disable`, { method: 'POST' })
  emit('refresh')
}
</script>

<style scoped>
.btn {
  background-color: #f3f4f6;
  border: 1px solid #d1d5db;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.875rem;
}
.btn:hover {
  background-color: #e5e7eb;
}
</style>
