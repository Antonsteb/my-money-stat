<script setup>
import { ref, watch  } from 'vue';
import { ColorPicker } from "vue3-colorpicker";
import "vue3-colorpicker/style.css";
import InputLabel from "@/Components/form/info/InputLabel.vue";
import InputError from "@/Components/form/info/InputError.vue";

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    errorMessage:String,
    label:String,
    type: String,

});


const emits = defineEmits(['update:modelValue']);
const pureColor = ref("red");
watch(pureColor, async (newQuestion, oldQuestion) => {
    emits('update:modelValue', newQuestion)
})

</script>
<template>
    <InputLabel v-if="label" for="bank" :value="label" class="form-label" />
    <color-picker v-model:pureColor="pureColor" :pureColorChange="(e) => {console.log(e)}" disable-alpha/> <!--v-model:gradientColor="gradientColor"-->
    <InputError :message="errorMessage" class="mt-2" />
</template>

<style scoped>

</style>
