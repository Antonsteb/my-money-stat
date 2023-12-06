<script setup>
import {useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/form/buttons/SecondaryButton.vue";
import Select from "@/Components/form/fields/Select.vue";
import {useCategoriesStore} from "@/store/categories.js";
import {useChartParamsStore} from "@/store/cahrtParams.js";
import {onMounted} from "vue";


const categoriesStore = useCategoriesStore()
const chartParamsStore = useChartParamsStore()

const form = useForm({
    type: null,
    interval: null,
    category_id: null,
});

onMounted(()=> {


})


const sendFile = () => {
    form.post(route('charts.add'), {
        preserveScroll: true,
        // onSuccess: () => closeModal(),
        // onError: () => passwordInput.value.focus(),
        // onFinish: () => form.reset(),
    });
};
</script>

<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Выберете категории данные которых будут использованы для графика
        </h2>

        <form @submit.prevent="sendFile">
            <Select
                id="type"
                v-model="form.type"
                :errorMessage="form.errors.type"
                class="mt-6 block w-3/4"
                label="Тип графика"
                placeholder="Выберете тип"
                :options="chartParamsStore.types"
            />

            <Select
                id="interval"
                v-model="form.interval"
                :errorMessage="form.errors.interval"
                class="mt-6 block w-3/4"
                label="Интервал"
                placeholder="Выберете интервал"
                :options="chartParamsStore.intervals"
            />

            <Select
                id="categoryId"
                v-model="form.category_id"
                :errorMessage="form.errors.category_id"
                class="mt-6 block w-3/4"
                label="Категория"
                placeholder="Выберете категорию"
                :options="categoriesStore.categoriesForSelect"
            />


            <div class="mt-6 flex justify-end">
                <SecondaryButton type="submit" :disabled="form.processing"> Сохранить </SecondaryButton>
            </div>
        </form>


    </div>
</template>


<style scoped>

</style>
