<script setup>
import SecondaryButton from "@/Components/form/buttons/SecondaryButton.vue";
import {mande} from "mande";




const redirect = async (social) => {
    const api = mande(route('social.url', {'social': social}))
   let response = await api.get()
    console.log(response);

    window.location.href = response.url;
};
</script>

<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Выберете способ входа
        </h2>
        <div class="mt-4 ">
        <div class="grid grid-cols-1 gap-6 w-max">
            <SecondaryButton :onclick="() => {redirect('vk')}"> Войти через Vk </SecondaryButton>
            <SecondaryButton :onclick="() => {redirect('yandex')}"> Войти через Яндекс </SecondaryButton>
            <SecondaryButton :onclick="() => {redirect('pass')}"> Войти по логину и паролю </SecondaryButton>

        </div>
        </div>
    </div>
</template>


<style scoped>

</style>
