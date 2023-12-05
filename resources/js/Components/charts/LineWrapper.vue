<script setup>
import { onMounted, ref } from 'vue';
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'
import {options} from "@/config/charts/default";

ChartJS.register(Title, Tooltip, Legend, LineElement, CategoryScale, LinearScale, PointElement)

defineProps({
    // modelValue: {
    //     type: String,
    //     required: true,
    // },
});

// defineEmits(['update:modelValue']);

const chartData = ref({
    labels: [ 'January', 'February', 'March'],
    datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 80],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
    }]
});

</script>

<template>
    <div>
        <Line :data="chartData" :options="options"/>
    </div>
</template>
