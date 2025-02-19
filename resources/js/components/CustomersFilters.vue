<template>
    <div class="filters">
        <label for="startDate">Nar. od</label>
        <input id="startDate" type="date" v-model="localStartDate" />

        <label for="endDate">Nar. do</label>
        <input id="endDate" type="date" v-model="localEndDate" />
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    startDate: String,
    endDate: String
})
const emit = defineEmits(['update:startDate', 'update:endDate'])

const localStartDate = computed({
    get() {
        return props.startDate
    },
    set(value) {
        emit('update:startDate', value)
    }
})

const localEndDate = computed({
    get() {
        return props.endDate
    },
    set(value) {
        emit('update:endDate', value)
    }
})
</script>

<style scoped>
.filters {
    display: flex;
    align-items: center;
    gap: 1em;
    margin-bottom: 1em;
}

@media (max-width: 600px) {
    .filters {
        flex-direction: column;
        align-items: flex-start;
    }
}

label {
    margin-right: 0.5em;
}

input {
    margin-right: 0.5em;
    padding: 0.3em;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>
