<script setup>
import { ref } from 'vue';
import {
    Chart as ChartJS,
    ArcElement,
    Tooltip,
    Legend
} from 'chart.js'
import { Pie } from 'vue-chartjs'
import {options} from "@/config/charts/default";

ChartJS.register(ArcElement, Tooltip, Legend)

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
//     labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
//     datasets: [
//         {
//             backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
//             // borderColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
//             data: [40, 20, 80, 10]
//         }
//     ]
// });

</script>
//:style="{height: `auto`,}"
<template>
    <div class="h-full p-4">
        <Pie :data="chartData" :options="options" />
    </div>
</template>
