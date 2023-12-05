import { defineStore } from 'pinia'
import { mande } from 'mande'

const api = mande('/api/categories/all')

export const useCategoriesStore = defineStore('categories', {
    state: () => {
        return { categories:[] }
    },
    getters: {
        // automatically infers the return type as a number
        categoriesForSelect(state) {
            console.log(state.categories)
            console.log(Object.fromEntries(state.categories.map(obj => [obj.id, obj.name])))
            return Object.fromEntries(state.categories.map(obj => [obj.id, obj.name]));
        },
    },
    actions: {
        async get() {
            this.categories = await api.get().then(data => data.categories)
        },
    },
})
