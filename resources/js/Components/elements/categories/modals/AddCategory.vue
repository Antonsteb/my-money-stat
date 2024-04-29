<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/form/fields/TextInput.vue";
import SecondaryButton from "@/Components/form/buttons/SecondaryButton.vue";
import Colorpicker from "@/Components/form/fields/Colorpicker.vue";
import DangerButton from "@/Components/form/buttons/DangerButton.vue";
import {mande} from "mande";
import { router } from '@inertiajs/vue3'

const props = defineProps({
    categoryEditing: {
        default: {}
    },
    closeModal: {
        type: Function,
        required:true
    },
});
console.log(props.categoryEditing)
const form = useForm({
    parent_id: props.categoryEditing.parent_Id,
    name: props.categoryEditing.name,
    color: props.categoryEditing.color,
    id: props.categoryEditing.id,
});


const sendCategory = (e) => {
    console.log(form);
    const options = {
        preserveScroll: true,
        onSuccess: () => props.closeModal(),
        // onError: () => passwordInput.value.focus(),
        // onFinish: () => form.reset(),
    };
    if (props.categoryEditing?.id){
        form.put(route('categories.edit'), options);
    } else {
        form.post(route('categories.add'), options);
    }
};
const removeCategory = (e) => {
    e.preventDefault();
    const result = confirm('вы уверенны что хотите удалить категорию?');
    if (result) {
        const categoryDeleteApi = mande(route('categories.delete', {'id': props.categoryEditing.id}));
        categoryDeleteApi.delete();
        props.closeModal();
        router.reload();
    }
}
</script>


<template>
    <div class="p-6">

        <form @submit.prevent="sendCategory">
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
                <DangerButton class="mr-4" @click="removeCategory" >Удалить</DangerButton>
                <SecondaryButton type="submit" :disabled="form.processing"> Отправить </SecondaryButton>
            </div>
        </form>


    </div>
</template>


<style scoped>

</style>
