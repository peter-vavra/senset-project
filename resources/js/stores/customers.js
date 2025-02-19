import { defineStore } from 'pinia';
import axios from 'axios';

export const useCustomersStore = defineStore('customers', {
    state: () => ({
        customers: [],
        selectedMonth: null,
    }),
    actions: {
        async fetchCustomers() {
            try {
                const response = await axios.get('http://localhost:8000/api/customers');
                this.customers = response.data;
            } catch (error) {
                console.error('Error fetching customers:', error);
            }
        },
        async deleteCustomer(id) {
            try {
                await axios.delete(`http://localhost:8000/api/customers/${id}`);
                this.customers = this.customers.filter(c => c.id !== id);
            } catch (error) {
                console.error('Error deleting customer:', error);
            }
        },
        customersByMonth(month) {
            return this.customers.filter(customer => {
                const customerMonth = new Date(customer.dob).getMonth() + 1;
                return customerMonth === month;
            }).length;
        },
    },
    getters: {
        distribution(state) {
            const dist = {};
            for (let m = 1; m <= 12; m++) {
                dist[m] = 0;
            }
            state.customers.forEach(customer => {
                const month = new Date(customer.dob).getMonth() + 1;
                dist[month]++;
            });
            return dist;
        },
    },
});
