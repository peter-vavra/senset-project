<template>
    <div class="table-responsive">
        <h2>Zoznam zákazníkov:</h2>
        <table class="customers-table">
            <thead>
            <tr>
                <th>Meno</th>
                <th>DoB</th>
                <th>Akcie</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="customer in customers" :key="customer.id">
                <td>{{ customer.name }}</td>
                <td>{{ formatDate(customer.dob) }}</td>
                <td>
                    <button @click="$emit('delete', customer.id)">Zmazať</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
    customers: {
        type: Array,
        default: () => []
    }
})

const emit = defineEmits(['delete'])

function formatDate(dateStr) {
    const d = new Date(dateStr)
    return `${d.getDate()}.${d.getMonth() + 1}.${d.getFullYear()}`
}
</script>

<style scoped>
.table-responsive {
    width: 100%;
    overflow-x: auto;
    margin-bottom: 1em;
}

.customers-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 400px;
    border: 1px solid #ccc;
}

.customers-table th,
.customers-table td {
    border: 1px solid #ccc;
    padding: 0.75em;
    text-align: left;
    vertical-align: middle;
}

.customers-table th {
    background-color: #f2f2f2;
    font-weight: 600;
}

.customers-table tbody tr:nth-of-type(odd) {
    background-color: #fafafa;
}

.customers-table tbody tr:nth-of-type(even) {
    background-color: #ffffff;
}

.customers-table button {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 0.3em 0.6em;
    cursor: pointer;
    border-radius: 4px;
}

.customers-table button:hover {
    background-color: #c0392b;
}
</style>
