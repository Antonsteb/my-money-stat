<script setup>
import CategoryItem from "@/Components/elements/categories/CategoryItem.vue";
import {ref} from "vue";
import Modal from "@/Components/elements/Modal.vue";
import AddCategory from "@/Components/elements/categories/modals/AddCategory.vue";

defineProps({
    categories: Array
})

const addCategoryModal = ref(false);
const categoryEditing = ref({});

function openAddCategoryModal(parent_Id = null) {
    categoryEditing.value = {parent_Id: parent_Id}
    addCategoryModal.value = true
}
function openEditCategoryModal(category) {
    categoryEditing.value = category
    addCategoryModal.value = true
}
</script>

<template>
    <div>
        <div class="categories-list">
            <CategoryItem v-for="category in categories" :key="category.id" :category="category"
                          :open-add-category-modal="openAddCategoryModal"
                          :open-edit-category-modal="openEditCategoryModal"
            />
            <div class="add-category" @click="openAddCategoryModal()">+</div>
        </div>

        <Modal :show="addCategoryModal" @close="addCategoryModal = false">
            <AddCategory :category-editing="categoryEditing" :close-modal="() => addCategoryModal = false"/>
        </Modal>
    </div>
</template>

<style scoped>
.categories-list {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(auto-fill, 200px);
}
.add-category {
    color: rgba(31, 41, 55, 0.4);
    background-color: rgb(229 231 235);
    width: 200px;
    border-radius: 8px;
    font-size: 100px;
    height: 100%;
    text-align: center;
}
</style>
