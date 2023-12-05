<script setup>

import PrimaryButton from "@/Components/form/buttons/PrimaryButton.vue";
import PaymentsFileLoad from "@/Components/elements/my-payments/modals/PaymentsFileLoad.vue";
import Modal from "@/Components/elements/Modal.vue";
import {ref} from "vue";
import SetCategory from "@/Components/elements/my-payments/modals/SetCategory.vue";
import {useCategoriesStore} from "@/store/categories.js";

defineProps({
    payments: Array
})

const fileLoadModal = ref(false);
const setCategoryModal = ref(false);
const paymentId = ref(null);
const bankDescription = ref('');


const categoriesStore = useCategoriesStore()
categoriesStore.get();

function openSetCategoryModal(id){
    paymentId.value = id;
    setCategoryModal.value = true;
}
</script>

<template>
    <div>
        <PrimaryButton @click="fileLoadModal = true">Загрузить платежи из файла</PrimaryButton>
        <div class="bank-payments-head">
            <div>Банк</div>
            <div>Категория от банка</div>
            <div>Описание</div>
            <div>Сумма</div>
            <div>Дата</div>
            <div>Категория</div>
            <div>Действия</div>
        </div>
        <div class="bank-payments " v-for="payment in payments" :key="payment.id" >
            <div>{{payment.bank_name}}</div>
            <div>{{payment.bank_category_name}}</div>
            <div>{{payment.description}}</div>
            <div>{{payment.price}}</div>
            <div>{{payment.date}}</div>
            <div>иконка</div>
            <div>
                <img class="block icon w-auto m-auto" src="/images/icons/other-actions.png" alt="add"
                      @click="openSetCategoryModal(payment.id)"/>
            </div>
        </div>

        <Modal :show="fileLoadModal" @close="fileLoadModal = false">
            <PaymentsFileLoad/>
        </Modal>
        <Modal :show="setCategoryModal" @close="setCategoryModal = false">
            <SetCategory :payment_id="paymentId" />
        </Modal>
    </div>
</template>


<style scoped>
    .bank-payments-head,
    .bank-payments {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
        justify-items: center;
        grid-column-gap: 20px;
        grid-row-gap: 20px;
        color: rgb(156 163 175);
        padding: 20px;
    }
    .bank-payments-head {
        font-size: 24px;
        margin-top: 40px;
        border-bottom: 1px solid rgb(156 163 175);
    }

    .icon {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
</style>
