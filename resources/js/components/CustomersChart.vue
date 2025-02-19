<template>
    <div class="chart-wrapper">
        <Pie :data="chartData" :options="chartOptions" />
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { Pie } from 'vue-chartjs'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    ArcElement
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement)

const props = defineProps({
    filteredCustomers: {
        type: Array,
        default: () => []
    }
})

const monthNames = {
    "1": "január",
    "2": "február",
    "3": "marec",
    "4": "apríl",
    "5": "máj",
    "6": "jún",
    "7": "júl",
    "8": "august",
    "9": "september",
    "10": "október",
    "11": "november",
    "12": "december"
}

const chartData = computed(() => {
    const dist = {1:0, 2:0, 3:0, 4:0, 5:0, 6:0, 7:0, 8:0, 9:0, 10:0, 11:0, 12:0}

    props.filteredCustomers.forEach(customer => {
        const month = new Date(customer.dob).getMonth() + 1
        dist[month]++
    })

    return {
        labels: Object.keys(dist).map(m => monthNames[m]),
        datasets: [
            {
                data: Object.values(dist),
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF',
                    '#FF9F40',
                    '#66FF66',
                    '#FF6666',
                    '#66FFFF',
                    '#CCCCFF',
                    '#FFCC99',
                    '#CCCC99'
                ]
            }
        ]
    }
})

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false
}
</script>

<style scoped>
.chart-wrapper {
    width: 100%;
    height: 400px;
    border: 1px solid #ccc;
    margin-bottom: 1em;
    overflow: hidden;
}
</style>
