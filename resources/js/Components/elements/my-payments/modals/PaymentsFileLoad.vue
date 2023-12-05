<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/form/fields/TextInput.vue";
import InputError from "@/Components/form/info/InputError.vue";
import SecondaryButton from "@/Components/form/buttons/SecondaryButton.vue";
import FileInput from "@/Components/form/fields/FileInput.vue";
import Select from "@/Components/form/fields/Select.vue";


const form = useForm({
    bank: null,
    file: null,
});


const sendFile = () => {
    form.post(route('my-files.add'), {
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
            выберете файл и банк и нажмите загрузить
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Файл должен быть формата csv
        </p>

        <form @submit.prevent="sendFile">
            <FileInput
                v-model="form.file"
                :errorMessage="form.errors.file"
                class="mt-6 block w-3/4"
                type="file"
                accept=".csv"
                label="Файл"
            />
            <Select
                id="bank"
                ref="bankInput"
                v-model="form.bank"
                :errorMessage="form.errors.bank"
                class="mt-6 block w-3/4"
                label="Банк"
                placeholder="Выберете банк"
                :options="{sberbank:'Сбербанк',tinkoff:'Тинькоф'}"
            />


            <div class="mt-6 flex justify-end">
                <SecondaryButton type="submit" :disabled="form.processing"> Отправить </SecondaryButton>
            </div>
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
            </progress>
        </form>




    </div>
</template>


<style scoped>

</style>
