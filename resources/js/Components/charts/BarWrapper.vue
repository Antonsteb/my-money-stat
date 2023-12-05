<script setup>
import { ref } from 'vue';
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
} from 'chart.js'
import { Bar } from 'vue-chartjs'
import {options} from "@/config/charts/default";

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)

defineProps({
    // modelValue: {
    //     type: String,
    //     required: true,
    // },
});

// defineEmits(['update:modelValue']);

const chartData = ref({
    labels: [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ],
    datasets: [
        {
            label: 'Data One',
            backgroundColor: '#f87979',
            data: [40, 20, 12, 39, 10, 40, 39, 80, 40, 20, 12, 11]
        }
    ]
});

</script>

<template>
    <div>
        <Bar :data="chartData" :options="options"/>
    </div>
</template>
