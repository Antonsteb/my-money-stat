<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// >component.js
import {defineComponent, ref} from 'vue'

defineProps({
    charts: Array
})
// import { Head } from '@inertiajs/vue3';
import LineWrapper from "@/Components/charts/LineWrapper.vue";
import BarWrapper from "@/Components/charts/BarWrapper.vue";
import ChartsBord from "@/Components/elements/statistics/ChartsBord.vue";


</script>

<template>
    <AuthenticatedLayout>
<!--        <template #header>-->
<!--            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Profile</h2>-->
<!--        </template>-->

        <div class="p-12">
            <ChartsBord :charts="charts"/>
        </div>
    </AuthenticatedLayout>
</template>

<style>
</style>
