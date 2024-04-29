<script setup>
import {ref} from "vue";

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
const chartData = ref({
    labels: props.chartLabels,
    datasets:props.chartData
});
</script>
<template>
    <div class="h-full p-4">
        <p>Сумма по категории: {{props.chartLabels[0]}}</p>
        <p class="mt-4">{{props.chartData[0]}}</p>
    </div>
</template>
