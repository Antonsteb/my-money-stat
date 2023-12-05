<script setup>
import {useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/form/buttons/SecondaryButton.vue";
import Select from "@/Components/form/fields/Select.vue";
import {useCategoriesStore} from "@/store/categories.js";

const props = defineProps({
    payment_id: {
        required: true
    },
});


const categoriesStore = useCategoriesStore()

const form = useForm({
    category_id: null,
    payment_id: props.payment_id,
});


const sendFile = () => {
    form.post(route('payments.set-category'), {
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
            Выберете категорию для всех платежей с данным описанием
        </h2>

        <form @submit.prevent="sendFile">
            <Select
                id="categoryId"
                v-model="form.category_id"
                :errorMessage="form.errors.category_id"
                class="mt-6 block w-3/4"
                label="Категория"
                placeholder="Выберете Категорию"
                :options="categoriesStore.categoriesForSelect"
            />


            <div class="mt-6 flex justify-end">
                <SecondaryButton type="submit" :disabled="form.processing"> Отправить </SecondaryButton>
            </div>
        </form>


    </div>
</template>


<style scoped>

</style>
