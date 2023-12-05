<script setup>
import SecondaryButton from "@/Components/form/buttons/SecondaryButton.vue";

defineProps({
    category: {
        type: Object,
    },
    openAddCategoryModal: {
        type: Function,
    },
});
</script>

<template>
    <div class="category-item">
        <div class="category-item-head">
            <img v-show="openAddCategoryModal" class="block icon w-auto m-auto" src="/images/icons/add.png" alt="add"
                 @click="openAddCategoryModal(category.id)"
            />
            <div class="category-name">{{category.name}}</div>
            <img class="block icon w-auto m-auto" src="/images/icons/edit.png" alt="edit" />
        </div>
        <div class="subcategories" v-bind:style='{borderColor : category.color}'>
            <div class="subcategory" v-for="subcategory in category.subcategories"
                 :key="subcategory.id"
                 v-bind:style='{borderColor : subcategory.color}'
            >
                {{subcategory.name}}
            </div>
            <div class="mt-2">
            </div>
        </div>
    </div>
</template>

<style scoped>
.category-item {
    color: rgb(31 41 55);
    background-color: rgb(229 231 235);
    width: 100%;
    border-radius: 8px;
    overflow: hidden;
}
.category-item-head{
    display: grid;
    grid-template-columns: 30px 1fr 30px;
    border-bottom: 1px solid rgb(31 41 55);
}
.icon {
    width: 20px;
    height: 20px;
    cursor: pointer;
}
.category-name {
    text-align: center;
    padding: 10px;
}
.subcategories{
    padding: 10px;
    text-align: center;
    height: 100%;
    border-right: 6px solid;
}
.subcategory {
    margin-top: 0.5rem;
    padding: 10px;
    border-bottom-left-radius: 8px;
    border-top-left-radius: 8px;
    border: 1px solid;
    border-right: 6px solid;

}
</style>
