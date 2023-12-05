<template>
    <div>
        <InputLabel v-if="label" :value="label" class="form-label" />
        <div class="form-input p-0 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" >
            <input ref="file" type="file" :accept="accept" class="hidden" @change="change" />
            <div v-if="!modelValue" class="p-2">
                <button type="button" class="px-4 py-1 text-white text-xs font-medium bg-gray-500 hover:bg-gray-700 rounded-sm" @click="browse">Browse</button>
            </div>
            <div v-else class="flex items-center justify-between p-2">
                <div class="flex-1 pr-1">
                    {{ modelValue.name }} <span class="text-xs">({{ filesize(modelValue.size) }})</span>
                </div>
                <button type="button" class="px-4 py-1 text-white text-xs font-medium bg-gray-500 hover:bg-gray-700 rounded-sm" @click="remove">Remove</button>
            </div>
        </div>
        <InputError :message="errorMessage" class="mt-2" />
    </div>
</template>

<script>
import InputLabel from "@/Components/form/info/InputLabel.vue";
import InputError from "@/Components/form/info/InputError.vue";

export default {
    components: {InputError, InputLabel},
    props: {
        modelValue: File,
        label: String,
        accept: String,
        errorMessage: String,
    },
    emits: ['update:modelValue'],
    watch: {
        modelValue(value) {
            if (!value) {
                this.$refs.file.value = ''
            }
        },
    },
    methods: {
        filesize(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024))
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
        },
        browse() {
            this.$refs.file.click()
        },
        change(e) {
            this.$emit('update:modelValue', e.target.files[0])
        },
        remove() {
            this.$emit('update:modelValue', null)
        },
    },
}
</script>
