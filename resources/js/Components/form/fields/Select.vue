<script setup>
import InputError from "@/Components/form/info/InputError.vue";
import InputLabel from "@/Components/form/info/InputLabel.vue";
import {ref} from "vue";

defineProps({
    options: {
        type: Object,
        required: true,
    },
    modelValue: {
        required: true,
    },
    label:{
        type: String,
    },
    placeholder:{
        type: String,
    },
    errorMessage: {
        type: String,
    },
});

defineEmits(['update:modelValue']);

const open = ref(false);
</script>

<template>
    <div class="relative " >

        <InputLabel v-if="label" for="bank" :value="label" />
        <span class="inline-flex rounded-md w-full" @click="open = !open">
                                            <button
                                                type="button"
                                                class="inline-flex w-full items-center px-3 py-2 rounded-md text-gray-500 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                            >
                                                {{ options[modelValue] ?? placeholder }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4 absolute right-2"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
       </span>

        <InputError :message="errorMessage" class="mt-2" />
        <!-- Full Screen Dropdown Overlay -->
        <div v-if="open" class="fixed inset-0 z-40" @click="open = false"></div>

        <div
            v-show="open"
            class="absolute z-50 mt-2 rounded-md shadow-lg w-full"
            style="display: none"
            @click="open = false"
        >
            <div class="rounded-md ring-1 ring-black ring-opacity-5 w-full" >
                <p v-for="(option, key) in options"
                   @click="$emit('update:modelValue', key)"
                   class="block w-full px-4 py-2 text-left text-sm leading-5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                >{{option}}
                </p>
            </div>
        </div>
    </div>
</template>

