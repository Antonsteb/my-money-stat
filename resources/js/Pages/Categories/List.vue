<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CategoriesList from "@/Components/elements/categories/CategoriesList.vue";
import { Head } from '@inertiajs/vue3'

defineProps({
    categories: Array
})

</script>

<template>
    <Head>
        <title>Категории</title>
        <meta name="description" content="Редактирование категорий">
    </Head>

    <AuthenticatedLayout>
        <div class="py-12 px-24">
            <CategoriesList :categories="categories" />
        </div>
    </AuthenticatedLayout>
</template>

<style>
</style>
