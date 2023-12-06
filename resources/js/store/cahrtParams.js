import { defineStore } from 'pinia'
import { mande } from 'mande'

const typesApi = mande('/api/charts/params/types')
const intervalsApi = mande('/api/charts/params/intervals')

export const useChartParamsStore = defineStore('chartParams', {
    state: () => {
        return {
            types:[],
            intervals:[]
        }
    },
    actions: {
        async loadTypes() {
            this.types = await typesApi.get().then(data => data.types)
        },
        async loadIntervals() {
            this.intervals = await intervalsApi.get().then(data => data.intervals)
        },
    },
})
