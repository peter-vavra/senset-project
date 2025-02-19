<template>
    <div class="container">
        <CustomersFilters
            :startDate="startDate"
            :endDate="endDate"
            @update:startDate="val => startDate = val"
            @update:endDate="val => endDate = val"
            @applyFilter="applyFilter"
        />

        <CustomersChart :filteredCustomers="filteredCustomers" />

        <CustomersTable
            :customers="filteredCustomers"
            @delete="deleteCustomer"
        />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useCustomersStore } from '../stores/customers'
import CustomersFilters from './CustomersFilters.vue'
import CustomersChart from './CustomersChart.vue'
import CustomersTable from './CustomersTable.vue'

const store = useCustomersStore()

const startDate = ref('')
const endDate = ref('')

onMounted(() => {
    store.fetchCustomers()
})

const filteredCustomers = computed(() => {
    return store.customers.filter(customer => {
        const dob = new Date(customer.dob)
        const from = startDate.value ? new Date(startDate.value) : new Date('1900-01-01')
        const to = endDate.value ? new Date(endDate.value) : new Date('2100-01-01')
        return dob >= from && dob <= to
    })
})

function deleteCustomer(id) {
    store.deleteCustomer(id)
}
</script>

<style scoped>
.container {
    max-width: 800px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
    padding: 1em;
}

@media (max-width: 600px) {
    .container {
        padding: 0.5em;
    }
    h1 {
        font-size: 1.2rem;
    }
}
</style>
