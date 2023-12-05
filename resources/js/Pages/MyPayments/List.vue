<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PaymentsList from "@/Components/elements/my-payments/PaymentsList.vue";

defineProps({
    payments: Array
})
</script>

<template>
    <Head>
        <title>Платежи</title>
        <meta name="description" content="История платежей">
    </Head>

    <AuthenticatedLayout>
        <div class="py-12 px-24">
            <PaymentsList :payments="payments"/>
        </div>
    </AuthenticatedLayout>
</template>
