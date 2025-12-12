<template>
  <table class="table-auto w-full border-collapse">
    <thead>
      <tr class="bg-gray-100">
        <th class="px-4 py-2 text-left">Command</th>
        <th class="px-4 py-2 text-left">Expression</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-left">Pod</th>
        <th class="px-4 py-2 text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Render each task row -->
      <TaskRow
        v-for="task in tasks"
        :key="task.id"
        :task="task"
        @refresh="$emit('refresh')"
      />
    </tbody>
  </table>
</template>

<script setup>
/**
 * TaskList.vue
 *
 * Displays a table of scheduled tasks. Delegates row rendering and actions
 * to the TaskRow component.
 */

import TaskRow from './TaskRow.vue'

defineProps({
  tasks: {
    type: Array,
    required: true
  }
})
</script>
