<script setup>
import { onMounted, ref } from 'vue';
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

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div>
        <InputLabel v-if="label" for="bank" :value="label" class="form-label" />
        <input
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
            :type="type"
        />
        <InputError :message="errorMessage" class="mt-2" />
    </div>
</template>
