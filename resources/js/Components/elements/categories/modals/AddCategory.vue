<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/form/fields/TextInput.vue";
import SecondaryButton from "@/Components/form/buttons/SecondaryButton.vue";
import Colorpicker from "@/Components/form/fields/Colorpicker.vue";

const props = defineProps({
    parentId: {
        default: null
    },
    name: {
        default: ''
    },
    color: {
        default: "red"
    },
    closeModal: {
        type: Function,
        required:true
    },
});

const form = useForm({
    parent_id: props.parentId,
    name: props.name,
    color: props.color,
});


const sendFile = () => {
    form.post(route('categories.add'), {
        preserveScroll: true,
        onSuccess: () => props.closeModal(),
        // onError: () => passwordInput.value.focus(),
        // onFinish: () => form.reset(),
    });
};
</script>


<template>
    <div class="p-6">

        <form @submit.prevent="sendFile">
            <TextInput
                id="parent_id"
                name="parent_id"
                type="hidden"
                v-model="form.parent_id"
                :errorMessage="form.errors.parent_id"
            />

            <TextInput
                id="name"
                name="name"
                label="Название"
                class="mt-1 block w-full"
                v-model="form.name"
                :errorMessage="form.errors.name"
                required
                autofocus
            />
            <div class="mt-10"></div>
            <Colorpicker
                label="Цвет"
                v-model="form.color"
                :errorMessage="form.errors.color"
            />


            <div class="mt-6 flex justify-end">
                <SecondaryButton type="submit" :disabled="form.processing"> Отправить </SecondaryButton>
            </div>
        </form>


    </div>
</template>


<style scoped>

</style>
