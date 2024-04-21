import { defineStore } from 'pinia'

export const useGlobalModalsStore = defineStore('globalModals', {
    state: () => {
        return {
            loginType:false
        }
    }
})
