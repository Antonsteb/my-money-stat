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

const props = defineProps({
    chartData: {
        type: Array,
        required: true,
    },
    chartLabels: {
        type: Array,
        required: true,
    },
});
options.spanGaps = true
const chartData = ref({
    labels: props.chartLabels,
    datasets:props.chartData
});
// const chartData = ref({
//     labels: ['123', '123', '123', '123', '123', '123', '123'],
//     datasets: [{
//         label: 'My First Dataset',
//         data: [65, null, 80, 81, 56, 55, 40],
//         // fill: false,
//         borderColor: 'rgb(75, 192, 192)',
//         // tension: 0.1
//     }]
// });

</script>
//:style="{height: `auto`,}"
<template>
    <div class="h-full p-4">
        <Line :data="chartData" :options="options" />
    </div>
</template>
