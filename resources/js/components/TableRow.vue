<template>
    <tr>
        <td>{{ customer.name }}</td>
        <td>{{ formatDate(customer.dob) }}</td>
        <td>
            <button @click="$emit('delete', customer.id)">Zmazať</button>
        </td>
    </tr>
</template>

<script setup>
import { defineProps } from 'vue'
const props = defineProps({
    customer: {
        type: Object,
        required: true
    }
})

function formatDate(dateStr) {
    const d = new Date(dateStr)
    return `${d.getDate()}.${d.getMonth() + 1}.${d.getFullYear()}`
}
</script>

<style scoped>
button {
    background-color: #e74c3c;
    padding: 0.3em 0.6em;
    border: none;
    cursor: pointer;
}
button:hover {
    background-color: #c0392b;
}
</style>
